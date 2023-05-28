const PromotionsCreateEdit = {

    load: function (promotion, product) {
        $('[name="discount_type"]').val(promotion.flat_discount == null ? 'percentage' : 'flat');
        $('[name="company_id"]').val(promotion.company_id);
        $('[name="discount"]').val(promotion.flat_discount == null ? promotion.percentage_discount : promotion.flat_discount);
        $('[name="starting_from"]').val(promotion.starting_from);
        $('[name="product_url"]').val(product.url);
        $('[name="product_image_path"]').val(product.image_path);
        $('[name="product_price"]').val(product.price);
        $('[name="category_id"]').val(promotion.category_id);
        $('[name="product_name"]').val(product.name);
        $('[name="ends_on"]').val(promotion.ends_on);
        $('[name="amount"]').val(promotion.amount);
        $('[name="product_description"]').val(product.description);
        $('#product_image').attr('src', $("[name='product_image_path']").val());
    }
};
