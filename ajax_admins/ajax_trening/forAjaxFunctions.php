<?php
function search_video($pdo, $search){
    $sql = "SELECT id, name_tyan, name_video, video FROM video
            WHERE sort_name LIKE :search OR name_tyan LIKE :search";
    $query = $pdo->prepare($sql);
    // Добавляем символы % для поиска по подстроке
    $query->execute(['search' => "%$search%"]);
    return $query->fetchAll();
};
function get_video($pdo){
    $sql = "SELECT id,user_added,name_video,name_tyan,likes,sort_name FROM video";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}
function delete_video($pdo, $id) {
    $sql = "DELETE FROM video WHERE id = ?";
    $query = $pdo->prepare($sql);

    return $query->execute([$id]); // Возвращает true при успехе
}
