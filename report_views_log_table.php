<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Views</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" />

    
</head>
<body>
<div style="width:50%;text-align:left;">
<table id="reportTable" class="display">
    <thead>
        <tr>
            <th>Timestamp</th>
            <th>Username</th>
            <th>Page Type</th>
            <th>Report ID</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $pseudoSql = "SELECT timestamp, username, Page_ID, Page_Type WHERE message = ?";
        $parameters = ['Report/Dashboard views log'];
        $result = $module->queryLogs($pseudoSql, $parameters);
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['timestamp'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['Page_Type'] . "</td>";
            echo "<td>" . $row['Page_ID'] . "</td>";
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
$(document).ready(function() {
    $('#reportTable').DataTable({
        paging: true,
        order: [['0', 'desc']],
        initComplete: function () {
            this.api().columns().every(function () {
                let column = this;
                let title = column.header().textContent;

                // Create input element
                let input = document.createElement('input');
                input.placeholder = "Search: " + title;
                $(input).on('keyup change', function () {
                    if (column.search() !== this.value) {
                        column.search(this.value).draw();
                    }
                });

                // Append input to column header
                $(column.footer()).empty().append(input);
            });
            this.api().columns.adjust().draw();

        }
    });
});
</script>


</body>
</html>
