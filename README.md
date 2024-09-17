# README

## Introduction

This External Module (EM) creates a log for each visited report or dashboard page within the REDCap project. It facilitates the identification of which reports and dashboards are viewed and used by the users and which ones are deprecated. The html code of the visited dashboard is also logged (only for dashboard)
**The log displays visited pages from EM installation time, it does not act retrospectively.**


<u>Notes:</u>
<br>- API activities on reports are not logged.
<br>- Variables are not piped within the html code.

## Result
![image](https://github.com/user-attachments/assets/6553b382-0a1c-41b2-8969-d870c052ae04)
**View html code**
![image](https://github.com/user-attachments/assets/1bed3ef2-17dd-4b0f-a14a-2ee284b62074)
**View Page**
![image](https://github.com/user-attachments/assets/31c25c00-3204-4c9a-bd25-c16283fe7426)




## For Developers
### report_views_log

In the `report_views_log.php` page, a log is implemented to register each visit to a report or dashboard page. This log captures essential information about the visited page, such as the timestamp, user, and page type.

### report_views_log_table

The `report_views_log_table.php` file complements the log functionality by presenting the recorded data in a structured format. It creates an HTML page where the log from `report_views_log.php` is queried and displayed.

