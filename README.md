# README

## Introduction

This External Module (EM) provides functionality to create a log for each visited report or dashboard page within the REDCap project. It facilitates the identification of which reports and dashboards are viewed and used by the users and which ones are deprecated.
**The log displays visited pages from EM installation time, it does not act retrospectively.**

N.b: API activities on reports are not logged.

## Result

![image](https://github.com/ThomasVermes/report_views_log/assets/75424115/6ec6be20-6f50-462b-8e9e-9a32fa51e47a)

## For Developers
### report_views_log

In the `report_views_log.php` page, a log is implemented to register each visit to a report or dashboard page. This log captures essential information about the visited page, such as the timestamp, user, and page type.

### report_views_log_table

The `report_views_log_table.php` file complements the log functionality by presenting the recorded data in a structured format. It creates an HTML page where the log from `report_views_log.php` is queried and displayed.

