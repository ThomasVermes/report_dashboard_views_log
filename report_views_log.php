<?php
// Set the namespace defined in your config file
namespace USBTOV\report_views_log;

USE REDCap;
// Declare your module class, which must extend AbstractExternalModule 
class report_views_log extends \ExternalModules\AbstractExternalModule {

  public function redcap_every_page_top($project_id)
  {
     
    // from report tweak EM
      // Bail if user isn't logged in
      /*
      if (!defined("USERID")) {
          return;
      }
      */

      //get report_id from the URL
      $report_id = htmlspecialchars($_GET["report_id"]);

      // Reports Page (Edit or View Report, Not the all-reports page or stats/charts)
      if ($this->isPage('DataExport/index.php') && $project_id && $report_id &&
      !isset($_GET['stats_charts']) &&
      !isset($_GET['create']) &&
      !isset($_GET['other_export_options']) &&
      !isset($_GET['addedit'])) {

      REDCap::logEvent("Test action description", "test changes_made \nfirst_name = 'Paul'", NULL, NULL, $project_id);

      
      $logId = $this->log(
        "Report views log",
        [
          "your_parameter_name" => $report_id,
          "your_other_parameter_name" => "some string"
        ]
      );
      $pseudoSql = "select timestamp, username, your_parameter_name where message = ?";
      $parameters = ['Report views log']; //parameter is a required field then I have to put it somehow

      $result = $this->queryLogs($pseudoSql, $parameters);
      while ($row = $result->fetch_assoc()) {
        $timestamp = $row['timestamp'];
        $username = $row['username'];
        $your_parameter_name = $row['your_parameter_name'];
        $query_results .= "Timestamp: $timestamp, Username: $username, report_id: $your_parameter_name\n";
      }

      // JavaScript to open modal with query results
      $encoded_query_results = json_encode($query_results);
      echo "<script>
              var modal = document.createElement('div');
              modal.innerHTML = $encoded_query_results;
              modal.style.position = 'fixed';
              modal.style.top = '50%';
              modal.style.left = '50%';
              modal.style.transform = 'translate(-50%, -50%)';
              modal.style.backgroundColor = '#fff';
              modal.style.padding = '20px';
              modal.style.border = '1px solid #000';
              modal.style.zIndex = '9999';
              document.body.appendChild(modal);
            </script>";

  //LOG
      $date_time_stamp = date("Y-m-d_H-i-s");
      file_put_contents('C:/Bitnami/wampstack-8.1.10-0/apache2/htdocs/redcap/modules/report_views_log_v1.0.0/' . $project_id ."_" . $report_id . '_' . $date_time_stamp .'.txt', $query_results); //localhost
    }

  }
}
?>

