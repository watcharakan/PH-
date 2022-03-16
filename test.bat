:: contents of test.bat - make sure temp directory exists
@echo off
echo Batch File Started: %date% %time% >> c:\temp\status.txt 
:: Optionally log the received event and params for event types
echo Batch file started  >> c:\temp\status.txt 
echo Received eventType: %~1 >> c:\temp\status.txt 
echo Received param1: %~2 >> c:\temp\status.txt
echo Received param2: %~3 >> c:\temp\status.txt
echo Received param2: %~4 >> c:\temp\status.txt

:: Log the received event and params for a specific event type.
IF "%~1"=="countdown_start" ( 
  echo "Countdown Started" >> c:\temp\countdown_only.txt  
)

:: Optionally log the current date and time
echo Completed: %date% %time%  >> c:\temp\status.txt 