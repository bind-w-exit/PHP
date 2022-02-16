<html>
    <head>
        <title>Add New Operation</title>
    </head>
    <body>
        <?php echo $header_menu; ?>
        <form method="POST" action="index.php">
            <p>
                <label for="optype">Select operation type:</label>
            </p>
            <p>
                <select name="optype">
                    <?php echo $operation_options; ?>
                </select>
            </p>
            <p>
                <label for="opdata">Enter array with elements separated by space:</label>
            </p>
            <p>
                <input type="text" name="opdata" required>
            </p>
            <p>
                <input type="submit" value="Send data">
            </p>
        </form>
    </body>
</html>