<h3>新增最新消息資料</h3>
<hr>
<form action="./api/add.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>最新消息資料：</td>
            <td><input type="text" name="text"></td>
        </tr>
    </table>
    <div>
        <input type="hidden" name="table" value="News">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
    </div>
</form>