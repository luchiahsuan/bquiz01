<h3>更新動畫圖片</h3>
<hr>
<form action="./api/upload.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>最新消息資料：</td>
            <td>
                <textarea name="text" id="" cols="30" rows="10"></textarea>
            </td>
        </tr>

    </table>
    <div>
        <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
        <input type="hidden" name="table" value="News">
        <input type="submit" value="更新">
        <input type="reset" value="重置">
    </div>
</form>