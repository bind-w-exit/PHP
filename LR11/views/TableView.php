<html>
    <head>
        <title>View Data</title>
    </head>
    <body>
        <?php echo $header_menu; ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Operation</th>
                    <th>Input</th>
                    <th>Output</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $table_body; ?>
            </tbody>
        </table>
    </body>
</html>