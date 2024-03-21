<?php
// Set the namespace defined in your config file
namespace USBTOV\report_dashboard_views_log;

USE REDCap;
// Declare your module class, which must extend AbstractExternalModule 
class report_dashboard_views_log extends \ExternalModules\AbstractExternalModule {

  public function redcap_every_page_top($project_id)
  {

      //get report_id or dash_id from the URL
      $report_id = htmlspecialchars($_GET["report_id"]);
      $dash_id = htmlspecialchars($_GET["dash_id"]);

      // Reports Page (Edit or View Report, Not the all-reports page or stats/charts)
      if 
      (($this->isPage('DataExport/index.php') && $project_id && $report_id &&
      !isset($_GET['stats_charts']) &&
      !isset($_GET['create']) &&
      !isset($_GET['other_export_options']) &&
      !isset($_GET['addedit'])) ||
      //Dashboard Page
      ($this->isPage('index.php') && $_GET['route'] == 'ProjectDashController:view' && $project_id))
      {

        $page_type = '';
        $page_id = '';
        
        if ($report_id) {
        $page_type ='Report';
        $page_id = $report_id;
      } else if ($dash_id) {
        $page_type ='Dashboard';
        $page_id = $dash_id;
      }
       //EM log() method: 
      $logId = $this->log(
        "Report/Dashboard views log",
        [
          "Page_Type" => $page_type,
          "Page_ID" => $page_id,
        ]
      );
    }

  }
}
