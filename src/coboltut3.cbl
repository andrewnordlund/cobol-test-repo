       >>SOURCE FORMAT FREE
        IDENTIFICATION DIVISION.
        PROGRAM-ID. coboltut3.
        AUTHOR. Andrew Nordlund.
        DATE-WRITTEN.Sept 10, 2023
        ENVIRONMENT DIVISION.
        CONFIGURATION SECTION.
           SPECIAL-NAMES.
               CLASS PassingScore IS "A" THRU "C", "D".
        DATA DIVISION.
        FILE SECTION.
        WORKING-STORAGE SECTION.
        01 Age PIC 99 VALUE 0.
        01 Grade PIC 99 VALUE 0.
        01 Score PIC X(1) VALUE "B".
        01 CanVoteFlag PIC 9 VALUE 0.
           88 CanVote VALUE 1.
           88 CantVote VALUE 0.
        01 TestNumber PIC X.
           88 IsPrime VALUE "1", "3", "5", "7".
           88 IsOdd VALUE "1", "3", "5", "7", "9".
           88 IsEven VALUE "2", "4", "6", "8".
           88 LessThan5 VALUE "1" THRU "4".
           88 ANumber VALUE "0" THRU "9".

        PROCEDURE DIVISION.
           DISPLAY "Enter Age :" WITH NO ADVANCING
           ACCEPT AGE
           IF Age > 18 THEN
               DISPLAY "You can vote"
           ELSE
               DISPLAY "You can't vote"
           END-IF

           IF Age LESS THAN 5 THEN
               DISPLAY "Stay home"
           END-IF
           IF Age = 5 THEN
               DISPLAY "Go to Kindergarten"
           END-IF
           IF Age > 5 AND Age < 18 THEN
               COMPUTE Grade = AGe - 5
               DISPLAY "Go to Grade " GRADE
           END-IF
           IF Age GREATER THAN OR EQUAL TO 18
               DISPLAY "Go to College"
           END-IF


           IF Age > 18 THEN
               SET CanVote TO TRUE
           ELSE
                SET CantVote TO TRUE
           END-IF
           DISPLAY "Vote " CANVOTEFLAG

           DISPLAY "Enter Single Number or X to Exit: "
           ACCEPT TESTNUMBER
           PERFORM UNTIL NOT ANumber
               EVALUATE TRUE
                   WHEN IsPrime DISPLAY "Prime"
                   WHEN IsOdd DISPLAY "Odd"
                   WHEN IsEven DISPLAY "Even"
                   WHEN LessThan5 DISPLAY "Less than 5"
                   WHEN OTHER DISPLAY "Default Action"
                END-EVALUATE
                ACCEPT TESTNUMBER
           END-PERFORM

           STOP RUN.
