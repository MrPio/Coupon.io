const PromotionsCreateEdit = {

    load: function (promotion, product, coupled) {
        if (promotion.is_coupled == false) {
            $('[name="discount_type"]').val(promotion.flat_discount == null ? 'percentage' : 'flat');
            $('[name="discount"]').val(promotion.flat_discount == null ? promotion.percentage_discount : promotion.flat_discount);
            $('[name="product_url"]').val(product.url);
            $('[name="product_image_path"]').val(product.image_path);
            $('[name="product_price"]').val(product.price);
            $('[name="product_name"]').val(product.name);
            $('[name="product_description"]').val(product.description);
            $('#product_image').attr('src', $("[name='product_image_path']").val());
        } else {
            $('[name="extra_percentage_discount"]').val(promotion.extra_percentage_discount);
            $('[name="promotion_1"]').val(coupled[0].id);
            $('[name="promotion_2"]').val(coupled[1].id);
            if (coupled[2] != null)
                $('[name="promotion_3"]').val(coupled[2].id);
            if (coupled[3] != null)
                $('[name="promotion_4"]').val(coupled[3].id);
        }
        $('[name="company_id"]').val(promotion.company_id);
        $('[name="starting_from"]').val(promotion.starting_from);
        $('[name="category_id"]').val(promotion.category_id);
        $('[name="ends_on"]').val(promotion.ends_on);
        $('[name="amount"]').val(promotion.amount);
    }
};
