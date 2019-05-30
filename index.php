<?php
    require_once 'include/Db_Function.php';
    $database = new Db_Function();

    $keyword = '';

    if(isset($_POST["keyword"]))
    {
        $keyword = trim($_POST["keyword"]);
    }

    if($keyword =='')

        $result = $database->get_all_records();

    else 
        $result = $database->search_book($keyword);

?>

<html>
    <head>
        <title>
            Download Record from Mysql Database into excel
        </title>
    </head>
<body>
     <h3>Download Record from Mysql Database into excel</h3>  
     <p>
         <a href="add_book.php">Add Book</a>
         <form method="post">
             <input type="text" name="keyword" placeholder="Search Book name">
             <button name="submit">Search</button>
         </form>
     </p>
     <?php if(count($result)>0): ?>
        <table border="1">
            <tr>
                <th>BOOK ID</th>
                <th>BOOK NAME</th>
                <th>AUTHOR</th>
                <th>ISBN</th>
                <th>Action</th>
            </tr>
            <?php foreach($result as $res): ?>
                <tr>
                    <td><?php echo htmlentities($res["book_id"]); ?></td>
                    <td><?php echo htmlentities($res["book_name"]); ?>
                    <td><?php echo htmlentities($res["book_author"]); ?>
                    <td><?php echo htmlentities($res["book_isbn"]); ?>

                    <td>
                    
                        <a href="change.php?book_id=<?php echo htmlentities($res['book_id']); ?>">Change</a>
                        <a href="delete.php?book_id=<?php echo htmlentities($res["book_id"]); ?>" onclick="return confirm('Delete?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
        <a href="export.php">Export to Excel</a>
        <a href="download.php">Download</a>
     <?php else: ?>
        <p>No Record found</p>
     <?php endif ?>
</body>    
</html>