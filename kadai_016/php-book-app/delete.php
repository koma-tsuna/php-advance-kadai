<?php
$dsn = 'mysql:dbname=php_book_app;host=localhost;charset=utf8mb4';
$user = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $user, $password);

    // idカラムの値をプレースホルダに置き換えたSQL文を用意する
    $sql_delete = 'DELETE FROM books WHERE id = :id';
    $stmt_delete = $pdo->prepare($sql_delete);

    // 実際の値をプレースホルダに割り当てる　＞　bindValue()メソッド
    $stmt_delete->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

    // SQL文を実行する
    $stmt_delete->execute();

    // 削除した件数を取得する
    $count = $stmt_delete->rowCount();
    $message = "商品を{$count}件削除しました。";

    // 商品一覧ページへリダイレクトさせる（$messageパラメータも渡す）
    header("Location: read.php?message={$message}");

} catch(PDOException $e) {
    exit($e->getMessage());
}
?>