<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report and Dashboard Views</title>

</head>
<body>

<!--
1) Html Table
2) Bootstrap modal
3) Table in jquery
4) Actions for modal
 -->



<!--
////////////
HTML TABLE and SQL Query
////////////
 -->

<div style="width:50%;text-align:left;">
<table id="reportTable" class="display">
    <thead>
        <tr>
            <th>Timestamp</th>
            <th>Username</th>
            <th>Page Type</th>
            <th>Report/Dashboard ID</th>
            <th>View html code</th>
            <th>View Page</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $pseudoSql = "SELECT timestamp, username, Page_ID, Page_Type, Html_Code WHERE message = ?";
        $parameters = ['Report/Dashboard views log'];
        $result = $module->queryLogs($pseudoSql, $parameters);
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $module->escape($row['timestamp']) . "</td>";
            echo "<td>" . $module->escape($row['username']) . "</td>";
            echo "<td>" . $module->escape($row['Page_Type']) . "</td>";
            echo "<td>" . $module->escape($row['Page_ID']) . " </td>";
            //raw html code: based on $row['Html_Code']
            //if html code is empty (i.e. a report is logged, then button will appear disabled)
            if (empty($row['Html_Code'])) {
                    echo "<td><button class='btn btn-outline-secondary btn-xs' disabled>No code</button></td>";
                } else {
                    echo "<td><button name='view_code' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#viewModal' data-html='" . htmlspecialchars($row['Html_Code'], ENT_QUOTES, 'UTF-8') . "'>View code</button></td>";
                    
                }
            //interpreted html page: based on $row['Html_Code']
            if (empty($row['Html_Code'])) {
                echo "<td><button class='btn btn-outline-secondary btn-xs' disabled>No Page</button></td>";
            } else {
                echo "<td><button name='view_page' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#viewModal' data-html='" . htmlspecialchars($row['Html_Code'], ENT_QUOTES, 'UTF-8') . "'>View page</button></td>";
            }
            echo "</tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <th>placeholder for search field</th>
        <th>placeholder for search field</th>
        <th>placeholder for search field</th>
        <th>placeholder for search field</th>
        <th>placeholder for search field</th>
        <th>placeholder for search field</th>
</tfoot>
</table>
    </div>


<!--
////////////
Bootstrap Modal
////////////
 -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="viewModalLabel">Dashboard Content</h5>
                <div class="ml-auto">
                    <button type="button" id="copyToClipboard" class="btn btn-light btn-xs" aria-label="Copy to clipboard" onclick="copyToClipboard()">
                    <i class="fas fa-copy"></i> Copy to clipboard</button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Il contenuto del modale verrà inserito qui -->
            </div>
        </div>
    </div>
</div>



<script>
//JQuery DataTable initialisation, Library and plugin seems to be already integrated in REDCap
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

//////////////////
//Actions for modal
//////////////////

//global variable
var text_to_copy=''

//OPEN VIEW CODE MODAL
document.addEventListener('DOMContentLoaded', function() {
    // Logica per popolare il modale con il contenuto appropriato
    var viewModal = document.getElementById('viewModal');
    
    viewModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Bottone che ha attivato il modale
        var htmlContent = button.getAttribute('data-html'); // Recupera il contenuto da data-html
        if (!htmlContent) {
            htmlContent = "No info for this"; // Messaggio predefinito se l'attributo è vuoto
        }
        var modalBody = viewModal.querySelector('.modal-body');
        if (button.getAttribute('name') === "view_code") {
            modalBody.textContent = htmlContent; // raw html
            text_to_copy = modalBody.textContent
        } else if (button.getAttribute('name') === "view_page") {
            modalBody.innerHTML = htmlContent; // interpreted html
            text_to_copy = modalBody.innerText
        }

    });
});
        
function copyToClipboard() {
            navigator.clipboard.writeText(text_to_copy)
        }


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
