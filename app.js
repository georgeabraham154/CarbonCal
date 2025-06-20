const express = require ("express");
const mysql = require ("mysql2/promise");
const cors = require ("cors");


const app = express();
const port = 2003;
const router = express.Router();
app.use(express.json());
app.use(cors(
//     {
//     origin: '*'
// }
));
const getFoods = async (req,res) =>{
    try {
        const db = await mysql.createConnection({
                    host: 'localhost',
                    port: 3306,
                    user: 'root',
                    password: 'root',
                    database: 'carboncal'
                });
                const sql = "select * from countcalorie LIMIT 10";
                const [result] = await db.execute(sql);
                res.status(200).json(result)
                db.end();
            } catch (error) {
                res.status(406).json({error})
            }
        }
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
        const namafood = `%${food}%`;
        const sql = "select * from countcalorie where food LIKE ?";
        const [result] = await db.execute(sql,[namafood]);
        console.log(result);
        res.status(200).json(result);
        db.end();
    } catch (error) {
        res.status(407).json({error});
    }
}

router.get("/", (req,res) =>{
    console.log("masuk fungsi ini king")
    res.status(200).send("Wohoooo");
})

router.get("/foods",getFoods);
router.post("/food",getFood);
app.use("/", router);
app.listen(port, ()=>{
    console.log("App is running on port: "+port);
})

