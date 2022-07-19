<?php die(); ?>
Akeeba Backup for WordPress 3.0.1
================================================================================
+ WP-CLI integration
+ While importing backup archives, now they are sorted alphabetically
# [HIGH] Site Transfer Wizard: browser-specific BUTTON element behavior prevents using this feature in Firefox
# [LOW] Sorting the records displayed in Manage Backups and elsewhere would not work

Akeeba Backup for WordPress 3.0.0
================================================================================
# [LOW] JavaScript console error about jQuery.tooltip not being defined
# [LOW] JavaScript console error about $ not being defined in the Configuration page

Akeeba Backup for WordPress 3.0.0.b1
================================================================================
+ Rewritten user interface
# [LOW] The kicktemp folder and the kickstart.transfer.php file were not removed after Site Transfer Wizard had finished
# [LOW] The Transfer Wizard may select a chunk size which is too big for the target server
# [LOW] Using the Site Transfer Wizard may result in a "wordpress" folder being left behind on some servers with a broken FTP server (technically a bug with your FTP server; we had to remove a minor feature to work around it)
# [LOW] Add-on ANGIE language files would not be included in the backup archive
# [LOW] Leftover empty file after the end of the Configuration Wizard run
# [LOW] Restored WordPress sites would not work in wp-config.php erroneously contained a trailing closing PHP tag

Akeeba Backup for WordPress 2.4.1
================================================================================
+ Integrated Akeeba Backup updates within WordPress plugin update page
+ BackBlaze B2 integration (Pro only)
+ Introduction of remote.php alternative endpoint
~ PHP 7.2 compatibility: renaming Object class to BaseObject
~ Update Dropbox API with the new "_v2" endpoints where applicable
~ JSON API stepBackup: now enforcing the check for the MANDATORY parameter "backupid"
# [MEDIUM] Autoupdate feature was not working
# [MEDIUM] "Apply to all" filter button does not work due to a Javascript issue
# [MEDIUM] ALICE feature was not working
# [LOW] Core version: too many backup type options being shown
# [LOW] Core version: CLI scripts were included
# [LOW] Core version: some post-processing options were displayed even though the code to make them work was not present.
# [LOW] Misleading message about PHP version when the update server could not be reached
# [LOW] Fixed resetting stuck database updates
# [LOW] Exclude Files and Directories page cannot display errors when AJAX fails
# [LOW] WebDav post-processing: Fixed issue with hosts without a valid certificate file and SSL connections

Akeeba Backup for WordPress 2.4.0
================================================================================
+ Added warning if HHVM is used instead of PHP
+ Added variables for timezone information: [TIME_TZ], [TZ], [TZ_RAW], [GMT_OFFSET]
+ Custom backup timezone, changes the timezone the [DATE] and [TIME] variables are expressed in (gh-98)
+ Display the Secret Word unencrypted in the component's Options page (required for you to easily set up third party services)
# [LOW] Editing RegEx filters creates a new entry, doesn't edit in place (gh-95)
# [LOW] Repeated messages in the JavaScript console after editing a filter in Tabular or RegEx views (gh-96)

Akeeba Backup for WordPress 2.3.3
================================================================================
! [SECURITY] Secret Word for front-end and JSON backups is now stored encrypted in the database (as long as settings encryption in the application's Options is NOT disabled and your server supports encryption).
! [SECURITY] Improved internal authentication in restore.php makes brute forcing the restoration takeover a few dozen orders of magnitude harder.
~ [SECURITY] altbackup.php: verify SSL certificates by default. Use --no-verify command line option to revert to the old behavior.
- [SECURITY ADVICE] ANGIE will no longer lock its session to prevent information leaks. Please always use the ANGIE Password feature.
+ ANGIE for WordPress: better UI for the data replacement page
# [HIGH] Editing two or more Multiple Databases definitions consecutively would overwrite all of them with the settings of the last definition saved
# [HIGH] Disabling decryption can lead to loss of current settings
# [MEDIUM] ANGIE: WordPress Replace Data step may have a To value "null" instead of an empty string
# [LOW] "_QQ_" shown during restoration instead of double quotes
# [LOW] ANGIE: restoring sites served by a server cluster could result in "random" errors due to session handling being tied to the server IP

Akeeba Backup for WordPress 2.3.2
================================================================================
# [HIGH] Inconsistent WordPress usermeta handling can lead to blank pages in the plugin
# [HIGH] Error about $this when trying to display the error page leads to a seemingly blank page instead

Akeeba Backup for WordPress 2.3.1
================================================================================
! CLI scripts were not working properly

Akeeba Backup for WordPress 2.3.0
================================================================================
+ Prevent simultaneous use of ANGIE (restoration script) from two or more people / browsers
+ Using the WordPress database for temporary storage instead of PHP sessions
+ Alphabetical sorting of engines and installation scripts in the Configuration page
+ Support for Google Storage native JSON API
# [HIGH] Cannot change database prefix on restoration if the backup was taken with No Dependency Tracking enabled
# [MEDIUM] Double slashes in the WebDAV path cause 0 byte uploads on some servers
# [MEDIUM] Javascript race condition could cause some modals to not get triggered
# [LOW] Notice thrown converting memory_limit to bytes under PHP 7.1
# [LOW] Size units not displayed in Manage Backups page
# [LOW] Manage Backups page: dismissing the How Do I Restore dialog was not possible

Akeeba Backup for WordPress 2.2.0
================================================================================
# [HIGH] Large database records can cause an infinitely growing runaway backup or, if you're lucky, a backup crash due to exceeding PHP time limits.
# [HIGH] PHP Fatal Error if the row batch size leads to an amount of data that exceeds free PHP memory
# [HIGH] Resuming after error was broken when using the file storage for temporary files (default)
# [HIGH] WordPress multisite restoration: cannot log in if it's a directory-based multisite and you are restoring to the site's root
# [HIGH] WordPress multisite restoration: the path to the default site is not updated when restoring to a subdirectory making it impossible to access the site
# [HIGH] WordPress restoration: .htaccess RewriteRule has unnecessary path when restoring to a subdirectory, leading to routing issues.
# [MEDIUM] Errors when reading the backup engine's state were not reported, causing the backup to seem like it runs forever
# [MEDIUM] Database storage wouldn't report the lack of stored engine state, potentially causing forever stuck backups
# [MEDIUM] Blank page if you delete all backup profiles from the database (a default backup profile could not be created in this case)
# [MEDIUM] Errors always result in the resume pane being shown, no matter what your settings are
# [MEDIUM] WordPress restoration: .htaccess RewriteBase does not contain trailing forward slash when restoring to a subdirectory, may cause routing issues in some cases
# [MEDIUM] Logic error leads to leftover temporary database dump files in the backup output directory under some circumstances
# [MEDIUM] Database hostname localhost:3306 leads to connection error under some circumstances. Note that this hostname is wrong: you should use localhost without a port instead!
# [LOW] FTP/SFTP over cURL uploads would fail if the remote directory couldn't be created
# [LOW] The Warnings pane was always displayed following resuming from a backup error

Akeeba Backup for WordPress 2.1.3
================================================================================
# [HIGH] A build error resulted in the language strings not being included in the package
# [MEDIUM] Integrated restoration leads to an error message about the file extension being wrong

Akeeba Backup for WordPress 2.1.2
================================================================================
~ Control Panel: Display the backup date/time in the user's timezone
~ Date and time shown in Site Transfer Wizard is in the user's local timezone instead of GMT
# [HIGH] The installation ZIP file of the application contained double folders / files leading to unnecessary bloat.
# [HIGH] Archive integrity and restoration of JPS archives fails (the archive is valid, it's the extraction script that's the problem). THe previous fix didn't address the issue in full.
# [LOW] Fixed default backup description
# [LOW] Manage Backups: editing a backup shows two "Description" areas when the second one is really the "Comment" area.
# [LOW] Tooltips not showing
# [LOW] PHP 5.3 compatibility in the OpenSSL adapter (settings encryption)

Akeeba Backup for WordPress 2.1.1
================================================================================
# [HIGH] Integrated restoration: clicking Run the Installer does nothing; you can still run the installer manuallyim
# [HIGH] Archive integrity and restoration of JPS archives fails (the archive is valid, it's the extraction script that's the problem).
# [HIGH] The update feature was not working due to a Javascript error
# [LOW] Restoration was not removing password protection from the administrator folder even if requested to

Akeeba Backup for WordPress 2.1.0
================================================================================
! SECURITY: Workaround for MySQL security issue CVE-2016-5483 (https://blog.tarq.io/cve-2016-5483-backdooring-mysqldump-backups/) affecting SQL-only backups. This is a security issue in MySQL itself, not our backup engine. Full site backups / restoration were NOT affected.
+ You can use multiple PushBullet tokens to notify multiple accounts
# [HIGH] PHP's memory_limit given in bytes (e.g. 134217728 instead of 128M) prevent the backup from running
# [HIGH] Cannot download backups (Javascript error) [gh-88]
# [MEDIUM] Wrong replacements restoring WordPress sites on a subdirectory if the original site was in the domain root
# [LOW] Wrong log URL in the backup page after a backup is completed successfully.

Akeeba Backup for WordPress 2.1.0.b1
================================================================================
+ Add support for Canada (Montreal) Amazon S3 region
+ Add support for EU (London) Amazon S3 region
+ Support for JPS format v2.0 with improved password security
+ Hide action icons based on the user's permissions
+ Modified permissions: on single sites Editors can take backups, Administrators can take and download backups, Super Admins have full access. On multi-site installations only Super Admins have access.
~ Permissions are now more reasonably assigned to different views
~ Now using the Reverse Engineering database dump engine when a Native database dump engine is not available (PostgreSQL, Microsoft SQL Server, SQLite)
# [MEDIUM] Infinite recursion if the current profile doesn't exist
# [MEDIUM] Views defined against fully qualified tables (i.e. including the database name) could not be restored on a database with a different name

Akeeba Backup for WordPress 2.0.4
================================================================================
+ Alternative FTP post-processing engine and DirectFTP engine using cURL providing better compatibility with misconfigured and broken FTP servers
+ Alternative SFTP post-processing engine and DirectSFTP engine using cURL providing compatibility with a wide range of servers
~ Anticipate and report database errors in more places while backing up MySQL databases
~ Set the default database dump engine to Native (faster, supports procedures, triggers and functions)
# [HIGH] Site Transfer Wizard does not work with single part backup archives
# [HIGH] Running the Configuration Wizard would result in the wrong database driver being displayed in the Configuration page
# [HIGH] Trailing slashes in the Directory name would cause donwloading a backup back from Dropbox to fail
# [HIGH] Outdated, end-of-life PHP 5.4.4 in old Debian distributions has a MAJOR bug resulting in file data not being backed up (zero length files). We've rewritten our code to work around the bug in this OLD, OUTDATED, END-OF-LIFE AND INSECURE version of PHP. PLEASE UPGRADE YOUR SERVERS. OLD PHP VERSIONS ARE **DANGEROUS**!!!
# [MEDIUM] Dumping VIEW definers in newer MySQL versions can cause restoration issues when restoring to a new host
# [MEDIUM] Dropbox: error while fetching the archive back from the server
# [MEDIUM] Error restoring procedures, functions or triggers originally defined with inline MySQL comments
# [LOW] Folders not added to archive when both their subdirectories and all their files are filtered.
# [LOW] The Import button was shown in the Manage Backups page of the Core version where said feature doesn't exist
# [LOW] The database name could be included in PROCEDUREs, FUNCTIONs and TRIGGERs, making it impossible to restore the backup on a new server
# [LOW] The URL to fix our database tables' structure when we detect they're out of date was wrong

Akeeba Backup for WordPress 2.0.3
================================================================================
+ JSON API: export and import a profile's configuration
# [HIGH] Setting up Google Drive required manually copying the tokens due to a Javascript error
# [HIGH] Site Transfer Wizard fails on sites with too much memory or very fast connection speeds to the target site
# [HIGH] Site Transfer Wizard is missing a file required to transfer very large files to the remote server
# [MEDIUM] In several instances there was a typo declaring 1Mb = 1048756 bytes instead of the correct 1048576 bytes (1024 tiems 1024). This threw off some size calculations which, in extreme cases, could lead to backup failure.
# [MEDIUM] Obsolete records quota was applied to all backup records, not just the ones from the currently active backup profile
# [MEDIUM] Obsolete records quota did not delete the associated log file when removing an obsolete backup record
# [MEDIUM] Fixed typo in Site Transfer Wizard page, preventing the actual transfer
# [MEDIUM] Infinite loop creating part size in rare cases where the space left in the part is one byte or less
# [LOW] The changelog was not displayed when clicking on the "Changelog" button
# [LOW] ANGIE: Restoring WordPress 4.2+ from MySQL 5.6 to MySQL 5.5 or earlier fails due to WP using the utf8mb4_unicode_520_ci collation which is not available on older MySQL versions

Akeeba Backup for WordPress 2.0.2
================================================================================
+ ANGIE: Prevent direct web access to the installation/sql directory
~ PHP 5.6.3 (and possibly other old 5.6 versions) are buggy. We rearranged the order of some code to work around these PHP bugs.

Akeeba Backup for WordPress 2.0.1
================================================================================
! The ZIP archiver was not working properly

Akeeba Backup for WordPress 2.0.0
================================================================================
! mcrypt is deprecated in PHP 7.1. Replacing it with OpenSSL.
! Missing files from the backup on some servers, especially in CLI mode
+ ALICE raw output now is always in English
+ Added warning if database updates are stuck due to table corruption
+ Support the newer Microsoft Azure API version 2015-04-05
+ Support uploading files larger than 64Mb to Microsoft Azure
+ Added option to force Site Transfer even if some sanity checks are failing
+ Added warning if CloudFlare Rocket Loader is enabled on the site
+ You can now choose whether to display GMT or local time in the Manage Backups page
+ Sort the log files from newest to oldest in the View Log page (based on the backup ID)
+ View Log after successful backup now takes you to this backup's log file, not the generic View Log page
# [MEDIUM] Cannot download archives from S3 to browser when using the Amazon S3 v4 API
# [LOW] Reverse Engineering database dump engine must be available in Core version, required for backing up PostgreSQL and MS SQL Server
# [LOW] Wordpress restoration: Better handling of edge cases in wp-config file
# [LOW] Archive integrity check refused to run when you are using the "No post-processing" option but the "Process each part immediately" option was previously selected in a different post-processing engine
# [LOW] Total archive size would be doubled when you are using the "Process each part immediately" option but not the "Delete archive after processing" option (or when the post-processing engine is "No post-processing")
# [LOW] Warnings from the database dump engine were not propagated to the interface

Akeeba Backup for WordPress 1.9.3
================================================================================
+ Automatically handle unsupported database storage engines when restoring MySQL databases
# [HIGH] Failure to upload to newly created Amazon S3 buckets
# [MEDIUM] Import from S3 didn't work with API v4-only regions (Frankfurt, São Paulo)
# [LOW] The [WEEKDAY] variable in archive name templates returned the weekday number (e.g 1) instead of text (e.g. Sunday)
# [LOW] Deleting the currently active profile would cause a white page / internal server error
# [LOW] Chrome and other isbehaving browsers autofill the database username/password, leading to restoration failure if you're not paying very close attention. We are now working around these browsers.
# [LOW] WebDAV prost-processing: Fixed handling of URLs containing spaces

Akeeba Backup for WordPress 1.9.2
================================================================================
- Removed Dropbox API v1 integration. The v1 API is going to be discontinued by Dropbox, see https://blogs.dropbox.com/developers/2016/06/api-v1-deprecated/ Please use the Dropbox API v2 integration instead.
+ WordPress restoration: the default replacement data now includes the JSON-encoded versions of the data as well
+ WordPress restoration: all tables with the WP prefix are now pre-selected in the Replace Data page to minimise post-restoration issues from partial data replacement
+ Restoration: a warning is displayed if the database table name prefix contains uppercase characters
~ Workaround for sites with upper- or mixed-case prefixes / table names on MySQL servers running on case-insensitive filesystems and lower_case_table_names = 1 (default on Windows)
~ The backup engine will now warn you if you are using a really old PHP version
~ You will get a warning if you try to backup sites with upper- or mixed-case prefixes as this can cause major restoration issues.
# [HIGH] Conservative time settings (minimum execution time greated than the maximum execution time) cause the backup to fail
# [HIGH] Infinite loop if the #__ak_profiles table does not exist
# [MEDIUM] Restoration: The PDOMySQL driver would always crash with an error
# [LOW] WordPress restoration: the absolute path restoration missed the leading / for sites originating from non-Windows systems
# [LOW] Integrated Restoration: The last response timer jumped between values

Akeeba Backup for WordPress 1.9.1
================================================================================
~ Removed dependency on jQuery timers

Akeeba Backup for WordPress 1.9.0
================================================================================
+ Do not automatically display the backup log if it's too big
+ Halt the backup if the encrypted settings cannot be decrypted when using the native CLI backup script
+ Better display of tooltips: you now have to click on the label to make them static
+ Enable the View Log button on failed, pending and remote backups
~ Site Transfer Wizard is now available on PHP 5.3
# [HIGH] PHP's INI parsing "undocumented features" (read: bugs) cause parsing errors when certain characters are contained in a password.
# [LOW] Database dump could fail on servers where the get_magic_quotes_runtime function is not available

Akeeba Backup for WordPress 1.9.0.b2
================================================================================
# [LOW] The integrated restoration would appear to be in an infinite loop if an HTTP error occurred
# [HIGH] CLI scripts do not respect configuration overrides (bug in engine's initialization)
# [HIGH] Backups taken with JSON API would always be full site backups, ignoring your preferences

Akeeba Backup for WordPress 1.9.0.b1
================================================================================
! Cannot update automatically. Read the release notes.
+ Always install in wp-content/plugins/akeebabackupwp folder
~ Less confusing buttons in integrated restoration
# [HIGH] Remote JSON API backups always using profile #1 despite reporting otherwise
# [LOW] Logo flicker when going from page to page
# [LOW] Missing language keys in the Update section of System Configuration
# [LOW] Automatic description for command line (CLI) backups included a mangled date

Akeeba Backup for WordPress 1.8.2
================================================================================
# [HIGH] Remote JSON API backups always using profile #1
# [LOW] Backup download confirmation message had escaped \n instead of newlines

Akeeba Backup for WordPress 1.8.1
================================================================================
! Multipart backups are broken
# [HIGH] Remote JSON API backups would result in an error
# [HIGH] Front-end (remote) backups would always result in an error

Akeeba Backup for WordPress 1.8.0
================================================================================
+ Automatic detection and working around of temporary data load failure
+ Direct download link to Akeeba Kickstart in the Manage Backups page
+ Working around PHP opcode cache issues occurring right before the restoration starts if the old restoration.php configuration file was not removed
+ Schedule Automatic backups button is shown after the Configuration Wizard completes
+ Schedule Automatic backups button in the Configuration page's toolbar
+ Download log button from ALICE page
~ Chrome won't let developers restore the values of password fields it ERRONEOUSLY auto-fills with random passwords. We worked around Google's atrocious bugs with extreme prejudice. You're welcome.
~ ANGIE (restoration script): Reset APC cache after the restoration is complete (NB! Only if you use ANGIE's Remove Installation Directory feature)
- Google Drive: Removed "Download to browser" feature since it's not supported
# [MEDIUM] Fixed Rackspace CloudFiles when using a region different then London

Akeeba Backup for WordPress 1.7.1
================================================================================
! SQL error could prevent update

Akeeba Backup for WordPress 1.7.0
================================================================================
+ Google Drive integration
+ ANGIE: Warning message when you're trying to use a complex database password which may cause database restoration failure.
+ ANGIE: Improved UTF8MB4 support detection
+ ANGIE: Ability to downgrade UTF8MB4 data to UTF8
+ Added warning if the mbstring PHP extension is not installed
~ Added support for future installation/update packages with an enclosing akeebabackupwp folder
# [MEDIUM] Fixed recording of backup end time when a post-processing engine is used
# [LOW] JSON API failed to delete the backups
# [LOW] Multiple database definition: Fixed adding more databases at once

Akeeba Backup for WordPress 1.6.4
================================================================================
# [HIGH] Language files processed by Transifex caused the language parser to throw errors

Akeeba Backup for WordPress 1.6.3
================================================================================
# [HIGH] Front-end backup URL was not working
# [MEDIUM] Some servers with problematic libcurl implementations are unable to use Dropbox API v2, always receiving an error message.
# [MEDIUM] Upload to OneDrive occasionally fails when their API doesn't report the folder creation correctly

Akeeba Backup for WordPress 1.6.2
================================================================================
# [HIGH] The plugin mistakenly requires PHP 5.4 or later when it runs just fine on PHP 5.3.3 or later

Akeeba Backup for WordPress 1.6.1
================================================================================
# [HIGH] Possible backup failure when the database being backed up is of a different type (e.g. PostgreSQL vs MySQL) than the one containing the backup profile configuration
# [LOW] PHP Warning during session save

Akeeba Backup for WordPress 1.6.0
================================================================================
! Front-end and remote backup features will be DISABLED if we detect an insecure Secret Word
+ Added textual output to ALICE so it could be included in support tickets
+ Automatically run ALICE if an error occurs during the last domain of a backup
+ Support for Amazon S3's Standard- Infrequent Access storage type
+ Akeeba Backup for WordPress will set its own tables to utf8mb4 if your WordPress installation has utf8mb4 enabled
~ More stable Site Transfer Wizard thanks to improved transfer chunk size calculations
# [MEDIUM] One Click Backup buttons wouldn't actually switch the backup profile
# [LOW] No Status displayed in the Latest Backup module for successful backups
# [LOW] Added workaround for untranslated text caused by disabled parse_ini_* functions
# [LOW] Fixed typo in ALICE
# [LOW] Site Transfer Wizard, bad performance of the test FTP/SFTP servers could lead to an instant error when accessing this feature
# [LOW] Someone who already knows your Secret Word can store XSS in the database if the remote backup is enabled and you're not using Joomla!'s or Admin Tools' .htaccess file (discovered by NCC Group)

Akeeba Backup for WordPress 1.5.3
================================================================================
+ One-click backup icons. Select which profiles to display as one-click icons in Akeeba Backup's control panel
+ More prominent site restoration and transfer instructions in the Manage Backups page
# [HIGH] Chunked upload to OneDrive would result in an error
# [HIGH] Only 5Mb would be transferred to Amazon S3 on some hosts with PHP compiled against a broken libcurl library; workaround applied.
# [HIGH] Multipart upload to S3 fails when the file size is an integer multiple of the chunk size
# [HIGH] Amazon S3 has a major bug with Content-Length on some hosts when using single part uploads. We are now working around it.
# [MEDIUM] Using "Manage remote files" in the Manage Backups page could mangle backup profiles under some circumstances
# [LOW] Extra databases definition page, trying to validate the connection without any information entered results in a success message
# [LOW] Fixed supplying additional Download ID directly from the Control Panel page
# [LOW] Fixed backing up multiple external folders

Akeeba Backup for WordPress 1.5.2
================================================================================
# [HIGH] Under rare circumstances temporary data could be committed to the database and break future backups.
# [HIGH] Amazon S3 has a major bug with Content-Length on some hosts when using multipart uploads. We are now working around it.
# [HIGH] Google Storage and DreamObjects would not work
# [HIGH] Upload to S3 would fail due to cacert.pem issues with some hosts and versions of PHP
# [HIGH] Upload to S3 would fail if a file was an integer multiple of the Amazon S3 chunk size (5242880)

Akeeba Backup for WordPress 1.5.2.b1
================================================================================
- Removed the "Upload to Amazon S3 (legacy API)" post-processing engine. Existing backup profiles will be automatically migrated to the "Upload to Amazon S3" engine.
+ Akeeba Backup will ask you to enter your Download ID before showing you available updates.
+ Akeeba Backup will ask you to run the Configuration Wizard when it detects it's necessary. One less thing for you to remember!
+ JSON API: Return an error if preflight configuration checks indicate a critical error (e.g. output directory not writeable)
+ "Exclude error logs" filter, enabled by default, to prevent broken backup archives when error logs change their size / are rotated while the backup is in progress
~ Desktop notifications are now optional. If you have already enabled them don't worry, they won't be disabled (your browser remembers the previous setting).
~ Improved layout for the Control Panel page
~ New icon colour palette for easier identification of the Control Panel icons
~ The profile ID is displayed in the profile selection drop-down
~ Manage Backups: "Part 00" would be displayed when there is just one backup part present. Button label changed to "Download".
~ Manage Backups: Simplified the page layout
~ ANGIE: Removed the confusing messages about restoring to a different site or PHP version
~ ANGIE: Simplified the final page ("Finished")
~ Remove the title from the popover tips
# [HIGH] No error thrown when the engine state cannot be saved while the backup is in progress
# [HIGH] The database storage option for the temporary data didn't work
# [LOW] The backup size would be inflated if "Upload each part immediately" is enabled and it takes multiple step to post process a single archive part

Akeeba Backup for WordPress 1.5.0 and 1.5.1
================================================================================
~ These versions were removed shortly after release due to high priority issues in the Amazon S3 API.

Akeeba Backup for WordPress 1.4.2
================================================================================
# [LOW] The Size in Manage Backups would be wrong as the last part's size was counted twice

Akeeba Backup for WordPress 1.4.1
================================================================================
! Problem with the display of language strings

Akeeba Backup for WordPress 1.4.0
================================================================================
! The minimum required PHP version is now 5.4.0
+ Automatically check the integrity of the backup archive (opt-in, please read the documentation)
# [HIGH] Front-end and CLI backup does not work when your database password or username contains a comma
# [HIGH] Misconfigured servers would set the Secure cookie flag on plain HTTP sites leading to 500 Invalid Token errors. Now the default cookie flags are worked around with extreme prejudice!
# [HIGH] Multipart ZIP archives were broken
# [MEDIUM] ANGIE: You could not override the ANGIE password in the Backup Now page
# [LOW] The SQL query would not be printed on database errors

Akeeba Backup for WordPress 1.3.4
================================================================================
~ ANGIE: Improve memory efficiency of the database engine
~ Switching the default log level to All Information and Debug
+ CORE version; ALICE, automated backup issue resolution
+ CORE version; CLI scripts to schedule backups and check for failed scheduled backups
+ CORE version; Import backups already on the server
+ CORE version; Additional archivers; Direct FTP, Direct SFTP, JPS, ZIP (via ZipArchive)
+ CORE version; Additional fine-tuning options
+ CORE version; Integrated restoration
+ CORE version; Send archives by Email, FTP, SFTP
+ Support utf8mb4 in CRON jobs
# [LOW] Desktop notifications for backup resume showed "%d" instead of the time to wait before resume
# [LOW] Push notifications should not be enabled by default
# [MEDIUM] Dropbox integration would not work under many PHP 5.5 and 5.6 servers due to a PHP issue. Workaround applied.
# [HIGH] Restoring on MySQL would be impossible unless you used the MySQL PDO driver

Akeeba Backup for WordPress 1.3.3
================================================================================
! Packaging error leading to immediate backup failure

Akeeba Backup for WordPress 1.3.2
================================================================================
+ Push notifications with Pushbullet
# [HIGH] ANGIE: Restoration may fail or corrupt text on some servers due to UTF8MB4 support

Akeeba Backup for WordPress 1.3.1
================================================================================
~ Updated Import from S3 to use the official Amazon AWS SDK for PHP
~ ANGIE (restoration script): Reset OPcache after the restoration is complete (NB! Only if you use ANGIE's Remove Installation Directory feature)
+ You can set the backup profile name directly from the Configuration page
+ You can create new backup profiles from the Configuration page using the Save & New button
+ Desktop notifications for backup start, finish, warning and error on compatible browsers (Chrome, Safari, Firefox)
+ UTF8MB4 (UTF-8 multibyte) support in restoration scripts, allows you to correctly restore content using multibyte Unicode characters (Emoji, Traditional Chinese, etc)
# [HIGH] Restoration might be impossible if your database passwords contains a double quote character
# [MEDIUM] (Pro) Dropbox and iDriveSync: could not upload under PHP 5.6 and some versions of PHP 5.5
# [MEDIUM] Immediate crash when the legacy MySQL driver is not available
# [MEDIUM] (Pro) OneDrive upload could fail in CLI CRON jobs if the upload of all parts takes more than 3600 seconds
# [MEDIUM] (Pro) Reupload from Manage Backups failed when the post-processing engine is configured to use chunked uploads
# [MEDIUM] Sometimes, usually after updating WordPress, you'd get a 403 access denied until you cleared browser cookies
# [LOW] White page when the ak_stats database table is broken
# [LOW] (Pro) Wrong link to Download ID instructions page

Akeeba Backup for WordPress 1.3.0
================================================================================
+ Warning with information and instructions when you have PHP 5.3.3 or earlier instead of crashing with a blank page
+ Warning if you have an outdated PHP version which we'll stop supporting soon
+ gh-28 Native Microsoft Live OneDrive support
# [MEDIUM] Cancelling the creation of a new backup profile could lead to server error
# [MEDIUM] Import from S3 didn't work correctly

Akeeba Backup for WordPress 1.2.2
================================================================================
+ Added "Apply to all" button in Files and Directories Exclusion page
# [HIGH] Missing interface options on bad hosts which disable the innocent parse_ini_file PHP function
# [HIGH] ANGIE (restoration): Some bad hosts disable the innocent parse_ini_file PHP function resulting in translation and functional issues during the restoration
# [MEDIUM] ANGIE for Wordpress: Site url was not replaced when moving to a different server
# [MEDIUM] Update notification not displaying on some sites (Pro)
# [MEDIUM] Core: quote and time settings parameters are not visible in the Core release
# [MEDIUM] Warning thrown when connecting to the database - Issue Ref gh-23
# [LOW] Clicking the Configure button in the Profiles page can lead to error 500 on hosts with GET query parameter name length limits
# [LOW] ANGIE for Wordpress: fixed changing Admin access details while restoring
# [LOW] On some hosts you wouldn't get the correct installer included in the backup
# [LOW] Pro: Updater doesn't work properly on PHP 5.6 - Issue Ref gh-22

Akeeba Backup for WordPress 1.2.1.2
================================================================================
# [HIGH] Core: the front-end backup was broken

Akeeba Backup for WordPress 1.2.1.1
================================================================================
~ Core: WordPress.org was sending out unnecessary files with the package

Akeeba Backup for WordPress 1.2.1
================================================================================
# [HIGH] Control Panel icons not shown on some extremely low quality hosts which disable the innocuous parse_ini_file function. If you were affected SWITCH HOSTS, IMMEDIATELY!
# [HIGH] Old PHP 5.3 versions have a bug regarding Interface implementation, causing a PHP fatal error

Akeeba Backup for WordPress 1.2.0
================================================================================
~ New icon set in the main page
+ Now supports WordPress Multisite for restoration on new servers (you have to keep the same subdomain or subdirectory layout for your multisites)
# [HIGH] Javascript conflict with some plugins
# [LOW] Upload to Dropbox may not work on servers without a global cacert.pem file

Akeeba Backup for WordPress 1.2.0.rc5
================================================================================
! DirectoryIterator::getExtension is not compatible with PHP 5.3.4 and 5.3.5
- Removed the (broken) multipart upload from the legacy S3 post-processing engine. Please use the new "Upload to Amazon S3" option for multipart uploads.
# [HIGH] Bug in third party Guzzle library causes Amazon S3 multipart uploads of archives larger than the remaining RAM size to fail due to memory exhaustion.
# [HIGH] ANGIE for WordPress: The .htaccess was broken on restoration due to two typos in the code
# [MEDIUM] Fatal error on sites with open_basedir restrictions on the site's root

Akeeba Backup for WordPress 1.2.0.rc4
================================================================================
# [LOW] 500 error on some sites after updating to version 1.2

Akeeba Backup for WordPress 1.2.0.rc3
================================================================================
! Core version on WordPress.org had filenames in lowercase instead of uppercase, leading to immediate error loading the plugin

Akeeba Backup for WordPress 1.2.0.rc2
================================================================================
! Wrongly tagged Core version on WordPress.org

Akeeba Backup for WordPress 1.2.0.rc1
================================================================================
+ New and improved backup engine
+ ANGIE for WordPress: Update serialised data on restoration
+ ANGIE: Add warning about Live site URL on Windows
+ You can now sort and search records in the Profile Management page
~ Workaround for magic_quotes_gpc under PHP 5.3
~ Changed the .htaccess files to be compatible with Apache 2.4
~ Improved responsive display without cutting off the right side of the plugin's display
~ Layout tweaks in the Configuration page
# [HIGH] Magic quotes on PHP 5.3 could cause problems in filter pages
# [HIGH] [PRO] Update information not fetched unless you manually retry through the Update page
# [HIGH] [PRO] Akeeba Backup for WP Professional doesn't update correctly
# [MEDIUM] ANGIE: The option "No auto value on zero" was not working
# [MEDIUM] The data file pointer can be null sometimes when using multipart archives causing backup failures
# [MEDIUM] Upload to remote storage from the Manage Backups page was broken for Amazon S3 multipart uploads
# [MEDIUM] Race condition could prevent the reliable creation of JPS (encrypted) archives
# [LOW] ANGIE: Fixed table name abstraction when no table prefix is given
# [LOW] ANGIE: Fixed loading of translations
# [LOW] ANGIE for WordPress: The blog name and tagline were empty when restoring to a new server (thanks Dimitris!)
# [LOW] Workaround for badly written Wordpress plugins that are killing the request
# [LOW] Javascript errors in WP 4.0 due to subtle changes in script load order
# [LOW] Huge logo appearing on the page when WordPress debug mode is enabled
# [LOW] SFTP post-processing engine did not mark successfully uploaded backup as Remote
# [LOW] SFTP post-processing engine could not fetch the archive back to the server
# [LOW] Tooltips not showing for engine parameters when selecting a different engine (e.g. changing the Archiver Engine from JPA to ZIP)

Akeeba Backup for WordPress 1.1.5
================================================================================
# [HIGH] The integrated restoration is broken after the last security update

Akeeba Backup for WordPress 1.1.4
================================================================================
! [SECURITY: Medium] Possibility of arbitrary file writing while a backup archive is being extracted by the integrated restoration feature

Akeeba Backup for WordPress 1.1.3
================================================================================
! White page under certain versions of PHP

Akeeba Backup for WordPress 1.1.2
================================================================================
! Backup failure on certain Windows hosts and PHP versions due to the way these versions handle file pointers
! Failure to post-process part files immediately on certain Windows hosts and PHP versions due to the way these versions handle file pointers
# [HIGH] Translations wouldn't load
# [LOW] Exclude non-core tables button not working in database table exclusion page
# [LOW] Possible white page if you have are hosting multiple Akeeba Backup installations on the same (sub)domain

Akeeba Backup for WordPress 1.1.1
================================================================================
! Dangling file pointer causing backup failure on certain Windows hosts
~ CloudFiles implementation changed to authentication API version 2.0, eliminating the need to choose your location
~ Old MySQL versions (5.1) would return randomly ordered rows when dumping MyISAM tables when the MySQL database is corrupt up to the kazoo and about to come crashing down in flames
# [LOW] Database table exclusion table blank and backup errors when your db user doesn't have adequate privileges to show procedures, triggers or stored procedures in MySQL
# [LOW] Could not back up triggers, procedures and functions

Akeeba Backup for WordPress 1.1.0
================================================================================
+ Support for iDriveSync accounts created in 2014 or later
+ A different log file is created per backup attempt (and automatically removed when the backup archives are deleted by quotas or by using Delete Files in the interface)
+ You can now run several backups at the same time
+ The minimum execution time can now be enforced in the client side for backend backups, leading to increased stability on certain hosts
+ Back-end backups will resume after an AJAX error, allowing you to complete backups even on very hosts with very tight resource usage limits
+ The Dropbox chunked upload can now work on files smaller than 150Mb and will work across backup steps, allowing you to upload large files to Dropbox without timeout errors
+ Backups resulting in an AJAX error will be retried, in case backup failure was caused by a temporary server or network issue
+ Workaround for missing jQuery (old versions of WordPress or plugins corrupting jQuery loading in wp-admin)
+ Greatly improve the backup performance on massive tables as long as they have an auto_increment column
+ Work around the issues caused by some servers' error pages which contain DOM-modifying JavaScript
+ Work around for the overreaching password managers in so-called modern browsers which fill irrelevant passwords in the configuration page.
# [HIGH] Dropbox upload would enter an infinite loop when using chunked uploads
# [HIGH] Potential information leak through the JSON API using a Decryption Oracle attack
# [MEDIUM] Core version: missing remote backup feature
# [MEDIUM] Notice thrown from AppConfig.php
# [MEDIUM] ANGIE: Restoring off-site directories would lead to errors
# [LOW] ANGIE for WordPress, phpBB and PrestaShop: escape some special characters in passwords
# [LOW] Some language strings inherited from Akeeba Backup for Joomla! reference Joomla! instead of WordPress

Akeeba Backup for WordPress 1.0.6
================================================================================
! [HIGH] Information disclosure through the JSON API. This is a theoretical attack since we determined it is impractical to perform outside a controlled environment.
# [HIGH] Front-end backup wasn’t included in the Core version.

Akeeba Backup for WordPress 1.0.5
================================================================================
# [HIGH] Apparently the SVN issue causing the packaging problem with 1.0.2, 1.0.3 and 1.0.
4 is still unresolved and we still get white pages for some Professional features. We now
reset the SVN repository, hoprefully fixing the issue.

Akeeba Backup for WordPress 1.0.4
================================================================================
# [HIGH] Packaging error leads to error pages when trying to access Professional features
from the Core release.

Akeeba Backup for WordPress 1.0.3
================================================================================
! [HIGH] Packaging error leading to fatal error (white page)

Akeeba Backup for WordPress 1.0.2
================================================================================
# [HIGH] Leftover jQuery files from 1.0.b2 and earlier would be loaded in the stable release
# [HIGH] Missing Javascript file errors when WordPress' debug mode is enabled
# [HIGH] [PRO] ANGIE: restoring off-site directories leads to unworkable permissions (0341) in their subdirectories due to a typo

Akeeba Backup for WordPress 1.0.0
================================================================================
# [HIGH] WordPress Plugins page would report the Core version as an update to the Professional release, leading to loss of functionality

Akeeba Backup for WordPress 1.0.b4
================================================================================
~ Reorganised JS and CSS loading to use WordPress' semantics
# [MEDIUM] Update page would always report that the PHP version is too old and refuse to update

Akeeba Backup for WordPress 1.0.b3 - 2014/05/05
================================================================================
! Configuration file changed from config.json to config.php – expect some turbulence after update
+ You can now change the date/time format for the Start column in the Manage Backups page
+ Support restoration of "split URL" WordPress sites (site root and WordPress root being different directories)
+ Basic support for WordPress Multisite: multisite installations can be backed up only by the network admin and can only be restored on the same server / URL as the original blog network
~ Much improved database installer / updater
~ Use WordPress' timezone instead of asking you to specify it manually
~ Update notifications are performed using AJAX to prevent a connection timeout from making Akeeba Backup for WordPress inaccessible
# [HIGH] CLI scripts not working when the wp-config.php file is above the site's root
# [HIGH] Fatal error when the session path is not writeable
# [MEDIUM] The entire backup output folder was excluded from the backup, breaking Akeeba Backup when restored from a backup
# [MEDIUM] It wasn't possible to link to Dropbox
# [LOW] Sometimes the ANGIE password warning would appear without a password having been set
# [LOW] The profile selection box wouldn't show in the Backup Now page
# [LOW] The remote file management button in Manage Backups page doesn't open the interface in a pop-up as it should be

Akeeba Backup for WordPress 1.0.b2 - 2014/04/01
================================================================================
! Wrong name of Awf/Adapters/Curl.php file led to fatal error on some hosts
~ Enable debug mode when WordPress' debug mode (WP_DEBUG) is enabled
# [LOW] Download through browser warning showing \n instead of newlines
# [LOW] Beta version shown with an ALPHA badge

Akeeba Backup for WordPress 1.0.b1 - 2014/04/01
================================================================================
! First public release
