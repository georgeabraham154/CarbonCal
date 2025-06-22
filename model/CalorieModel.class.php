<?php
    class CalorieModel extends Model{
    function searchFoodsByCategory($query, $category){
        //fungsi ini dibuat nampilin suggestion
        $sql = "SELECT food, calories FROM countcalorie WHERE categorie = ? AND food LIKE ? LIMIT 10";
        $stmt = $this->db->prepare($sql);
        //query disini adalah nama makanan
        $searchTerm = '%' . $query . '%';
        $stmt->bind_param('ss', $category, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    function getFood($food,$berat){
        $sql = "SELECT food,calories,calories * $berat / 100 as calculated_calories, categorie FROM countcalorie WHERE food= '$food' LIMIT 1";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}