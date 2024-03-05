# README

## Introduction

This External Module (EM) provides functionality to create a log for each visited report or dashboard page within the REDCap project. It facilitate to identify which Reports and Dashboards are viewed and used by the users.  
N.b: API activities on reports are not recorded.

## report_views_log

In the `report_views_log.php` page, a log is implemented to record each visit to a report or dashboard page. This log captures essential information about the visited page, such as the timestamp, user, and page type.

## report_views_log_table

The `report_views_log_table.php` file complements the log functionality by presenting the recorded data in a structured format. It creates an HTML page where the log from `report_views_log.php` is queried and displayed. This page utilizes the following libraries:

- jQuery
- DataTables