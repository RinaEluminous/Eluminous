<?php

class SpokalPhpErrorLog {
    
    private $filename;
    
    public function __construct($filename) {
        $this->filename = $filename;
    }
    
    
    
    
    /**
     * Get an instance of this class that represents the PHP error log.
     * The log filename is detected automatically.
     *
     * @static
     * @return Elm_PhpErrorLog|WP_Error An instance of this log reader, or WP_Error if error loggin is not configured properly.
     */
    public static function autodetect() {
        $errorLoggingEnabled = ini_get('log_errors') && (ini_get('log_errors') != 'Off');
        $logFile = ini_get('error_log');
        $openBaseDir = ini_get('open_basedir');

        //Check for common problems that could prevent us from displaying the error log.
        if ( !$errorLoggingEnabled ) {
            return new WP_Error(
                'log_errors_off',
                'Error logging is disabled.'
            );
        } 
        else if ( empty($logFile) ) {
            return new WP_Error(
                'error_log_not_set',
                'Error log filename is not set.'
            );
        } 
        else if ( (strpos($logFile, '/') === false) && (strpos($logFile, '\\') === false) ) {
            return new WP_Error(
                'error_log_uses_relative_path',
                sprintf(
                    'The current error_log value <code>%s</code> is not supported. Please change it to an absolute path.',
                    esc_html($logFile)
                )
            );
        } 
        else if(!$openBaseDir){ 
            if ( !is_readable($logFile) ) {
                return new WP_Error(
                    'error_log_not_found',
                    sprintf (
                            'The log file <code>%s</code> does not exist or is inaccessible.',
                            esc_html($logFile)
                    )
                );
            }   
        }
        else if($openBaseDir){
            if(strpos($openBaseDir, $logFile) == false){
                return new WP_Error(
                    'error_log_not_found',
                    sprintf (
                            'The log file <code>%s</code> does not exist or is inaccessible.',
                            esc_html($logFile)
                    )
                );
            }
            else if(!is_readable($logFile)){
                 return new WP_Error(
                    'error_log_not_found',
                    sprintf (
                            'The log file <code>%s</code> does not exist or is inaccessible.',
                            esc_html($logFile)
                    )
                );
            }
        }
        return new self($logFile);
      
    }
    
    
    
    
    /**
     * Read the last N lines from a PHP error log.
     *
     * @param int $lineCount How many lines to read.
     * @param bool $skipEmptyLines
     * @return array|WP_Error An array of ['timestamp' => ..., 'message' => ...] entries or an error.
     */
    public function readLastLines($lineCount, $skipEmptyLines = false) {
        $lines = $this->readLastLinesFromFile($this->getFilename(), $lineCount, $skipEmptyLines);
        if ( $lines === null ) {
            return new WP_Error(
                'error_log_fopen_failed',
                sprintf(
                    'Could not open the log file "%s".',
                    esc_html($this->getFilename())
                )
            );
        }

        $lines = array_map(array($this, 'parseLogLine'), $lines);
        return $lines;
    }
    
    
    
    
    
    private function parseLogLine($line) {
        $line = rtrim($line);
        $timestamp = null;
        $message = $line;

        //Attempt to parse the timestamp, if any. Timestamp format can vary by server.
        //We expect log entries to be structured like this: "[date-and-time] error message".
        if ( (substr($line, 0, 1) === '[') &&  (strpos($line, ']') !== false) ) {
            list($parsedTimestamp, $remainder) = explode(']', $line, 2);
            $parsedTimestamp = strtotime(trim($parsedTimestamp, '[]'));
            if ( !empty($parsedTimestamp) ) {
                $timestamp = $parsedTimestamp;
                $message = $remainder;
            }
        }
        return compact('timestamp', 'message');
    }

    
    
    
    /**
     * Clear the log.
     * @return void
     */
    public function clear() {
        $handle = fopen($this->filename, 'w');
        fclose($handle);
    }
    
    
    

    public function getFilename() {
        return $this->filename;
    }

    
    
    
    public function getFileSize() {
        return filesize($this->getFilename());
    }
    
    
    

    /**
     * Read the last X lines from a file.
     *
     * @param string $filename
     * @param int $lineCount How many lines to read.
     * @param bool $skipEmptyLines
     * @param int $bufferSizeInBytes Read buffer size. Defaults to 5 KB.
     * @return array|null An array of text lines, or NULL if the file couldn't be opened.
     */
    private function readLastLinesFromFile($filename, $lineCount, $skipEmptyLines = false, $bufferSizeInBytes = 5120) {
        $handle = fopen($filename, 'rb');
        if ( $handle === false ) {
            return null;
        }

        $lines = array();
        $remainder = '';

        //Start reading from the end of the file. Then move back towards the start
        //of the file, reading it in $bufferSizeInBytes blocks.
        fseek($handle, 0, SEEK_END);
        $position = ftell($handle);

        while ( (count($lines) < $lineCount) && ($position != 0) ) {
            //Since $position is an offset from the start of the file,
            //it's also equal to the total amount of remaining data.
            $bytesToRead = ($position > $bufferSizeInBytes) ? $bufferSizeInBytes : $position;
            $position = $position - $bytesToRead;
            fseek($handle, $position, SEEK_SET);
            $buffer = fread($handle, $bytesToRead);

            //We may have a partial line left over from the previous iteration.
            $buffer .= $remainder;

            $newLines = preg_split('@\n@', $buffer, -1, $skipEmptyLines ? PREG_SPLIT_NO_EMPTY : 0);

            //It's likely that we'll start reading in the middle of a line (unless we're at
            //the start of the file), so lets leave the first line for later.
            if ( $position != 0 ) {
                $remainder = array_shift($newLines);
            }

            //Add the new lines to the start of the list.
            $lines = array_merge($newLines, $lines);
        }

        fclose($handle);
        return array_slice($lines, -$lineCount);
    }
    
    
    
    
    
    public static function displayConfigurationHelp($problem) {
        ?>
            <form method="post" id="form_error_log">
                <div class="error_log_wraper">
                    <input type="hidden" name="action" value="handling_form_error_log">
                    <p style="margin-top:0px; margin-bottom:0px;">To enable error logging click Enable.</p>
                    <p style="margin-top:0px;">(only do this if instructed to by Spokal support)</p>
                    <div style='float:left;'>
                        <?php SpokalAdminView::submitButton('Enable','error_log','primary');?>
                    </div>
                    <div class="spinner-container">
                        <span id="form-error-log-spiner" class="sp_spinner" style="display:none"></span>
                    </div>
                    <div style="clear:both"></div>
                </div>
                <p class="failed_error_log" style="color:red;"></p>
            </form>

        <?php
        
    }
    
    
    
    
    
    public static function render() {
        
        $log = SpokalPhpErrorLog::autodetect();
        
        if ( is_wp_error($log) ) {
            SpokalPhpErrorLog::displayConfigurationHelp($log);
            return;
        }
        else{
            echo 'Error Log is Enabled.';
        }
        
        $lines = $log->readLastLines(40, true);
        
        if ( is_wp_error($lines) ) {
            printf('<p>%s</p>', $lines->get_error_message());
        } 
        else if ( empty($lines) ) {
            echo '<table class="widefat">
                    <tbody>
                        <tr>
                            <td>
                                The log file is empty.
                            </td>
                        </tr>
                    </tbody>
                </table>';
        } 
        else {
            echo '<table class="widefat"><tbody>';
            $isOddRow = false;
            if(is_array($lines)){
                foreach ($lines as $line) {
                    $isOddRow = !$isOddRow;
                    printf(
                        '<tr%s><td style="white-space:nowrap;">%s</td><td>%s</td></tr>',
                        $isOddRow ? ' class="alternate"' : '',
                        !empty($line['timestamp']) ? $log->formatTimestamp($line['timestamp']) : '',
                        esc_html($line['message'])
                    );
                }
            }
            echo '</tbody></table>';

        }
        
    }
    
    
    
    
    public function formatTimestamp($timestamp) {
        return gmdate('M d, H:i:s', $timestamp);
    }
    
    
    
}
