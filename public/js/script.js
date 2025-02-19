function toggleSearch() {
    const searchInput = document.querySelector('.search-input');
    if (searchInput.style.display === 'none' || searchInput.style.display === '') {
        searchInput.style.display = 'block';
        searchInput.focus();
    } else {
        searchInput.style.display = 'none';
    }
}
$(document).ready(function () {
    // Load all products initially
    loadProducts(0);

    // Handle category button click
    $('.category-btn').click(function (e) {
        e.preventDefault(); // Prevent page reload
        var categoryId = $(this).data('category'); // Get category ID

        if (categoryId === undefined) {
            alert("Error: No category ID found.");
            return;
        }

        console.log("Category Clicked:", categoryId); // Debugging Log
        loadProducts(categoryId);
    });

    // AJAX Function to Load Products
    function loadProducts(categoryId) {
        $.ajax({
            url: "fetch_product.php",
            type: "GET",
            data: { category: categoryId },
            success: function (data) {
                console.log("AJAX Success:", data); // Debugging log
                $('#product-list').html(data); // Insert products dynamically
            },
            error: function (xhr, status, error) {
                alert("AJAX Error: " + error);
            }
        });
    }
});
let paymentMethod = selectedPayment === "razorpay" ? "Online" : "COD";

$.ajax({
    url: "order.php",
    type: "POST",
    data: {
        user_id: userId,
        product_id: productId,
        amount: amount,
        payment_method: paymentMethod,
        razorpay_payment_id: razorpayPaymentId // Only if online payment
    },
    success: function(response) {
        alert("Order placed successfully!");
        window.location.href = "orders.php";
    }
});

