<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHFDigiMart | Add Products</title>
    <link rel="stylesheet" href="test.css">
</head>
<body>
            <div class="container">
                <div class="hp">
                    <h2>Add Products</h2>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="error">
                    <div class="input-box">
                        <input type="text" placeholder="Product Name" name="pName" required>
                    </div>
                    
                    <div class="input-box">
                        <span></span><input type="file" name="pImage" required>
                    </div>
</div>

                    

                    <div class="error">
                    <div class="input-box">
                        <input type="text" placeholder="Product Price" name="pPrice" required>
                    </div>
                    
                    <div class="input-box"> 
                        <select name="pcategory" required>
                            <option value="">Category</option>
                            <option value="butchers">butchers</option>
                            <option value="greengrocer">greengrocer</option>
                            <option value="fishmonger">fishmonger</option>
                            <option value="bakery">bakery </option>
                            <option value="delicatessen">delicatessen</option>
                        </select>   
                    </div> 
</div>
                   

                    <div class="error">
                    <div class="input-box">
                        <select name="sName" required>
                            <option value="" selected>Select Shop</option>
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>

                    
                    <div class="input-box">
                        <input type="text" placeholder="Discount Percent" name="pDis" required>
                    </div>
</div>
                    
                    <div class="error">
                    <div class="input-box">
                        <input type="text" placeholder="Allergy Information" name="pAllergy">
                    </div>

                    <div class="input-box">
                        <input type="text" placeholder="Product Description" name="pDesc">
                    </div>
                    </div>

                    

                    <div class="error">
                    <div class="input-box">
                        <input type="text" name="pQuantity" placeholder="Quantity" required>
                    </div>
</div>
                    
                    

                    
                    
                    <div class="submit-box">
                        <input type="submit" name="psubmit" value="Add">
                    </div>
                </form>
            </div>
 


    
</body>
</html>