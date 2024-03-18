<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report and Dashboard Views</title>

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

<!-- JQuery DataTable initialisation, Library and plugin seems to be already integrated in REDCap -->
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
