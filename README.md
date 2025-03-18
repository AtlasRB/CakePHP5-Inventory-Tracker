A project used as an introduction into learning Cake PHP5.
This project was made with a wide range of requirements to fully explore this framework and to learn as much about cake as possible.

The project specifications include:

Models:
    Product Model with fields:
        id, name, quantity, price, status (in stock, low stock, out of stock).
        Add validation rules:
            name: Required, unique, must be between 3 and 50 characters.
            quantity: Integer, >= 0, <= 1000.
            price: Decimal, > 0, <= 10,000.
        Custom validation:
            Products with a price > 100 must have a minimum quantity of 10.
            Products with a name containing "promo" must have a price < 50.
Controllers:
    ProductsController with:
        index: List all products with filters for status (in stock, low stock, out of stock) and a search box for names.
        add: Add a new product.
        edit: Update product details.
        delete: Soft-delete products (set a deleted flag instead of removing them from the database).
Views:
    Product list page with:
        Columns: name, quantity, price, status, last updated.
    Search box for partial name matches.
    Pagination
    A form to add/edit products.
    A confirmation modal before deleting a product. 
Additional:
    Calculate the status dynamically based on quantity:
        in stock: Quantity > 10.
        low stock: Quantity between 1 and 10.
        out of stock: Quantity = 0.
    Implement a behaviour to automatically update the last_updated field whenever a product is modified. 
    Implement a unit test suite for the Product model and controller actions.
    Seed the database with 10 sample products, ensuring variety in status, price, and quantity.
