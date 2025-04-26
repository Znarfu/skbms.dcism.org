<?
include '../../dbh.inc.php';

$report_type = $_POST['report_type'];

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=' . $report_type . '_report.csv');
$output = fopen('php://output', 'w');

switch ($report_type) {
    case 'projects':
        $result = $connection->query("SELECT project_name, description, status FROM projects");
        fputcsv($output, ['Project Name', 'Description', 'Status']);
        break;
    case 'members':
        $result = $connection->query("SELECT full_name, position FROM members");
        fputcsv($output, ['Full Name', 'Position']);
        break;
    case 'funds':
        $result = $connection->query("SELECT purpose, amount, date_spent FROM fund_allocation");
        fputcsv($output, ['Purpose', 'Amount', 'Date Spent']);
        break;
    default:
        exit("Invalid report type.");
}

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit();