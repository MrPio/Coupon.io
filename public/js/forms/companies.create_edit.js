const CompaniesCreateEdit = {

    load: (company)=> {
        $('[name="name"]').val(company.name);
        $('[name="place"]').val(company.place);
        $('[name="url"]').val(company.url);
        $('[name="type"]').val(company.type);
        $('[name="color"]').val(company.color);
        $('[name="description"]').val(company.description);
    }
};
