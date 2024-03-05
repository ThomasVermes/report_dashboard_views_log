<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Views</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/select/2.0.0/css/select.dataTables.min.css" />

    
</head>
<body>

<table id="reportTable" class="display">
    <thead>
        <tr>
            <th>Timestamp</th>
            <th>Username</th>
            <th>Report ID</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $pseudoSql = "SELECT timestamp, username, your_parameter_name WHERE message = ?";
        $parameters = ['Report views log'];
        $result = $module->queryLogs($pseudoSql, $parameters);
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['timestamp'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['your_parameter_name'] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <th>Timestamp</th>
        <th>Username</th>
        <th>placeholder</th>
</tfoot>
</table>

  

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
    -->

<!-- DataTable extension: select -->
<script src="https://cdn.datatables.net/select/2.0.0/js/dataTables.select.min.js"></script>

<!-- JQuery DataTable initialisation -->
<script>
$(document).ready(function() {
    $('#reportTable').DataTable({
        paging: true,
        select: true,
        initComplete: function () {
            this.api().columns().every(function () {
                let column = this;
                let title = column.header().textContent;

                // Create input element
                let input = document.createElement('input');
                input.placeholder = title;
                $(input).on('keyup change', function () {
                    if (column.search() !== this.value) {
                        column.search(this.value).draw();
                    }
                });

                // Append input to column header
                $(column.footer()).empty().append(input);
            });
        }
    });
});
</script>


</body>
</html>
