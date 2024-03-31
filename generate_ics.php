<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to format dates into iCalendar format
    function format_date($date) {
        return date("Ymd\THis", strtotime($date));
    }

    // Get events from the form
    $events = explode("\n", $_POST["events"]);
    $eventRegex = '/^[A-Za-z]{3} \d{1,2}-[A-Za-z]{3} \d{1,2}: .+$/';

    // iCalendar header
    $ics = "BEGIN:VCALENDAR\r\n";
    $ics .= "VERSION:2.0\r\n";
    $ics .= "PRODID:-//Your Organization//Your Website//EN\r\n";

    // Loop through each event and add to the iCalendar
    foreach ($events as $event) {
        if (!preg_match($eventRegex, $event)) {
            // Invalid event format, redirect back with an error message
            header('Location: index.php?error=' . urlencode("Invalid event format: " . $event));
            exit();
        }

        $event_parts = explode(":", $event, 2);
        $date_title = trim($event_parts[0]);
        $title = trim($event_parts[1]);

        // Extract start and end dates (handle single-day and multi-day events)
        $date_parts = explode("-", $date_title);
        $start_date = format_date($date_parts[0]);
        $end_date = format_date($date_parts[1]);

        $ics .= "BEGIN:VEVENT\r\n";
        $ics .= "DTSTART:" . $start_date . "\r\n";
        $ics .= "DTEND:" . date('Ymd\THis', strtotime($end_date . ' +1 day')) . "\r\n";  // Adjust end date for multi-day events
        $ics .= "SUMMARY:" . $title . "\r\n";
        $ics .= "END:VEVENT\r\n";
    }

    // iCalendar footer
    $ics .= "END:VCALENDAR";

    // Output to the user as a downloadable file
    header('Content-Type: text/calendar; charset=utf-8');
    header('Content-Disposition: attachment; filename=calendar.ics');
    echo $ics;
    exit();
}
?>
