<?php
//Include Composer autoloading
require __DIR__ . '/vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Views</title>
<!--
JQuery libraries and its DataTables plug-in
Not necessary to refer them since they are already included in redcap. That is only true if in EM's config.json:
    "show-header-and-footer": true


Content delivery network (CDN):
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" />

composer:
<script src="/redcap/modules/report_views_log_v1.0.0/vendor/components/jquery/jquery.min.js"></script>
<script src="/redcap/modules/report_views_log_v1.0.0/vendor/datatables.net/datatables.net/js/dataTables.js"></script>    
<link rel="stylesheet" href="/redcap/modules/report_views_log_v1.0.0/vendor/datatables.net/datatables.net-dt/css/dataTables.dataTables.css">
<script src="/redcap/modules/report_views_log_v1.0.0/vendor/datatables.net/datatables.net/js/dataTables.js"></script>    
-->

</head>
<body>


<div style="width:50%;text-align:left;">
<table id="reportTable" class="display">
    <thead>
        <tr>
            <th>Timestamp</th>
            <th>Username</th>
            <th>Page Type</th>
            <th>Report/Dashboard ID</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $pseudoSql = "SELECT timestamp, username, Page_ID, Page_Type WHERE message = ?";
        $parameters = ['Report/Dashboard views log'];
        $result = $module->queryLogs($pseudoSql, $parameters);
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $module->escape($row['timestamp']) . "</td>";
            echo "<td>" . $module->escape($row['username']) . "</td>";
            echo "<td>" . $module->escape($row['Page_Type']) . "</td>";
            echo "<td>" . $module->escape($row['Page_ID']) . " </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <th>placeholder for search field</th>
        <th>placeholder for search field</th>
        <th>placeholder for search field</th>
        <th>placeholder for search field</th>
</tfoot>
</table>
    </div>
  


<!-- JQuery DataTable initialisation -->
<script>
jQuery(document).ready(function() {
    jQuery('#reportTable').DataTable({
        paging: true,
        order: [['0', 'desc']],
        initComplete: function () {
            this.api().columns().every(function () {
                let column = this;
                let title = column.header().textContent;

                // Create input element and sanitize it!
                let input = document.createElement('input');
                input.placeholder = "Search: " + title;
                jQuery(input).on('keyup change', function () {
                    let sanitizedValue = escapeHtml(this.value);

                    if (column.search() !== sanitizedValue) {
                        column.search(sanitizedValue).draw();
                    }
                });

                 // Append input to column header
                 jQuery(column.footer()).empty().append(input);
            });
            this.api().columns.adjust().draw();

        }
    });
});

function escapeHtml(unsafe) {
    return unsafe.replace(/&/g, "&amp;")
                 .replace(/</g, "&lt;")
                 .replace(/>/g, "&gt;")
                 .replace(/"/g, "&quot;")
                 .replace(/'/g, "&#039;");
}

</script>


</body>
</html>
