CREATE TABLE users (
    userID INT,
    fName VARCHAR(20) NOT NULL,
    lName VARCHAR(20) NOT NULL,
    username VARCHAR(20) UNIQUE NOT NULL,
    pword VARCHAR(20) NOT NULL,
    DOB DATE,
    email VARCHAR(40) NOT NULL,
    timeCreated TIMESTAMP,
    timeUpdated TIMESTAMP,
    CONSTRAINT PK_users PRIMARY KEY (userID)
);

CREATE TABLE recipes (
    recipeID INT,
    recipeName VARCHAR(50) UNIQUE NOT NULL,
    cookTime INT NOT NULL,
    ingredients VARCHAR(100) NOT NULL,
    CONSTRAINT PK_recipes PRIMARY KEY (recipeID)
);

CREATE TABLE favorite (
    userID INT,
    recipeID INT,
    CONSTRAINT PK_favorite PRIMARY KEY (userID, recipeID),
    CONSTRAINT FK_favoriteUser FOREIGN KEY (userID) REFERENCES users(userID),
    CONSTRAINT FK_favoriteRecipe FOREIGN KEY (recipeID) REFERENCES recipes(recipeID)
);

CREATE TABLE snack (
    recipeID INT,
    flavor VARCHAR(15) NOT NULL,
    CONSTRAINT PK_snack PRIMARY KEY (recipeID),
    CONSTRAINT FK_snackRecipe FOREIGN KEY (recipeID) REFERENCES recipes(recipeID)
);

CREATE TABLE breakfast (
    recipeID INT,
    prepTime INT NOT NULL,
    CONSTRAINT PK_breakfast PRIMARY KEY (recipeID),
    CONSTRAINT FK_breakfastRecipe FOREIGN KEY (recipeID) REFERENCES recipes(recipeID)
);

CREATE TABLE lunch (
    recipeID INT,
    calories INT NOT NULL,
    CONSTRAINT PK_lunch PRIMARY KEY (recipeID),
    CONSTRAINT FK_lunchRecipe FOREIGN KEY (recipeID) REFERENCES recipes(recipeID)
);

CREATE TABLE dinner (
    recipeID INT,
    serves INT NOT NULL,
    CONSTRAINT PK_dinner PRIMARY KEY (recipeID),
    CONSTRAINT FK_dinnerRecipe FOREIGN KEY (recipeID) REFERENCES recipes(recipeID)
);

CREATE TABLE ingredients (
    ingredientID INT,
    userID INT,
    ingredientName VARCHAR(20) NOT NULL,
    quantity INT NOT NULL,
    CONSTRAINT PK_ingredients PRIMARY KEY (ingredientID, userID),
    CONSTRAINT FK_userIngredients FOREIGN KEY (userID) REFERENCES users(userID)
);

CREATE TABLE groceryList (
    listID INT,
    userID INT,
    ingredients VARCHAR(100),
    userFName VARCHAR(20),
    CONSTRAINT PK_groceryList PRIMARY KEY (listID, userID),
    CONSTRAINT FK_userGroceryList FOREIGN KEY (userID) REFERENCES users(userID),
    CONSTRAINT FK_userNameGroceryList FOREIGN KEY (userFName) REFERENCES users(fName)
);