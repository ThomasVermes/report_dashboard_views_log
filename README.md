# README

## Introduction

This External Module (EM) provides functionality to create a log for each visited report or dashboard page within REDCap. It enhances project tracking by recording user interactions with reports and dashboards.

## report_views_log

In the `report_views_log.php` page, a log is implemented to record each visit to a report or dashboard page. This log captures essential information about the visited page, such as the timestamp, user, and page type.

## report_views_log_table

The `report_views_log_table.php` file complements the log functionality by presenting the recorded data in a structured format. It creates an HTML page where the log from `report_views_log.php` is queried and displayed. This page utilizes the following technologies:

- jQuery
- DataTables

Users can easily view and analyze the recorded interactions, facilitating project management and analysis.
