const express = require ("express");
const mysql = require ("mysql2/promise");

const app = express();
const port = 3000;
const router = express.Router();
app.use(express.json());


    const getFood = async (req,res)=>{
        try {
            const db = await mysql.createConnection({
                    host: 'localhost',
                    port: 3306,
                    user: 'root',
                    password: 'root',
                    database: 'carboncal'
            });
            const food = req.body.food;
            const berat = req.body.berat;
            const sql = `SELECT food,calories,calories * ${berat} / 100 as calculated_calories, categorie FROM countcalorie WHERE food= '${food}' LIMIT 1`;
            const [result] = await db.execute(sql);
            console.log(result);
            res.status(200).json(result[0]);
            db.end();
        } catch (error) {
            res.status(407).json({error});
        }
    }
const getFoodsSuggestion = async (req,res) =>{
    try {
        const db = await mysql.createConnection({
            host: 'localhost',
            port: 3306,
            user: 'root',
            password: 'root',
            database: 'carboncal'
        });
        const food = req.body.food;
        const category = req.body.category;
        // const foodName = `%${food}%`;
        const sql = `SELECT food as makanan, calories as kalori, categorie as kategori FROM countcalorie WHERE categorie = '${category}' AND food LIKE '%${food}%' LIMIT 10;`
        const [result] = await db.execute(sql);
        console.log(result)
        res.status(200).json(result);
        db.end();
        } catch (error) {
            res.status(407).json({error});
        }
    }

router.post("/Food",getFood);
router.post("/FoodSuggestion",getFoodsSuggestion);
app.use("/", router);
app.listen(port, ()=>{
    console.log("App is running on port: "+port);
})

