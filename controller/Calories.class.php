<?php 
class Calories extends Controller{
    function index(){
        $this->loadView('HitungKalori.php');
    }
    function form(){
        $kategori = $_GET['kategori'];
        $data = [
            'kategori' => $kategori
        ];
        $this->loadView('FormMakanan.php',$data);
    }
    function result(){
         if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?c=Calories&m=index');
            exit;
        }
        
        $konsumsi = $_POST['konsumsi'];
        $berat = $_POST['berat'];
        $model = $this->loadModel('CalorieModel');
        $data = $model->getFood($konsumsi,$berat);
        $food = $data[0]['food'];
        $calories = $data[0]['calories'];
        $category = $data[0]['categorie'];
        $calculated_calories = $data[0]['calculated_calories'];
        $data = [
            'food' => $food,
            'calories' => $calories,
            'total_calories' => (int)$calculated_calories,
            'berat' => $berat,
            'category' => $category
        ];
        $this->loadView('CalorieResult.php',$data);
    }
    function searchFood(){
        header('Content-Type: application/json');
        
        $query = $_GET['q'] ?? '';
        $kategori = $_GET['kategori'] ?? '';
        
        if (strlen($query) < 2) {
            echo json_encode([]);
            return;
        }
        
        $model = $this->loadModel('CalorieModel');
        $suggestions = $model->getFoodsSuggestion($query, $kategori);
        echo json_encode($suggestions);
    }
}