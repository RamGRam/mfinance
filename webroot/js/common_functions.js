 
$(".roadsideservice").select2({
    ajax: {
        url: function(term, page) {
            var url = web_root + "api/roadsideservices.json?fields=id,name&page=" + page + "&name=" + term;
            return url;
        },
        dataType: 'json',
        cache: true,
        results: function(result, page) {
            var out = new Array;
            $(result.data).each(function(i, element) {
                out.push({
                    'id': element.id,
                    'text': element.name
                });
            });
            return {
                results: out,
                more: (result.pagination.has_next_page == true)
            };
        }
    },
    escapeMarkup: function(markup) {
        return markup;
    },
    initSelection: function(element, callback) {
        var id = $(element).val();
        if (id !== "") {
            $.ajax(web_root + "api/roadsideservices.json?fields=id,name&id=" + id, {
                data: '',
                dataType: "json",
                cache: true
            }).done(function(result) {
                var out = new Array;
                $(result.data).each(function(i, element) {
                    out.push({
                        'id': element.id,
                        'text': element.name
                    });
                });
                if (out.length == 1) {
                    callback(out[0]);
                } else {
                    callback(out);
                }
            });
        }
    }
}).on("change", function() {
    $(".car,.variant").select2("val", "").trigger("change");
});


$(".customer").select2({
    ajax: {
        url: function(term, page) {
            var url = web_root + "api/customers.json?fields=id,name&page=" + page + "&name=" + term;
            return url;
        },
        dataType: 'json',
        cache: true,
        results: function(result, page) {
            var out = new Array;
            $(result.data).each(function(i, element) {
                out.push({
                    'id': element.id,
                    'text': element.name
                });
            });
            return {
                results: out,
                more: (result.pagination.has_next_page == true)
            };
        }
    },
    escapeMarkup: function(markup) {
        return markup;
    },
    initSelection: function(element, callback) {
        var id = $(element).val();
        if (id !== "") {
            $.ajax(web_root + "api/customers.json?fields=id,name&id=" + id, {
                data: '',
                dataType: "json",
                cache: true
            }).done(function(result) {
                var out = new Array;
                $(result.data).each(function(i, element) {
                    out.push({
                        'id': element.id,
                        'text': element.name
                    });
                });
                if (out.length == 1) {
                    callback(out[0]);
                } else {
                    callback(out);
                }
            });
        }
    }
}).on("change", function() {
    $(".car,.variant").select2("val", "").trigger("change");
});


$(".brand").select2({
    ajax: {
        url: function(term, page) {
            var url = web_root + "api/brands.json?fields=id,brand_name&page=" + page + "&brand_name=" + term;
            return url;
        },
        dataType: 'json',
        cache: true,
        results: function(result, page) {
            var out = new Array;
            $(result.data).each(function(i, element) {
                out.push({
                    'id': element.id,
                    'text': element.brand_name
                });
            });
            return {
                results: out,
                more: (result.pagination.has_next_page == true)
            };
        }
    },
    escapeMarkup: function(markup) {
        return markup;
    },
    initSelection: function(element, callback) {
        var id = $(element).val();
        if (id !== "") {
            $.ajax(web_root + "api/brands.json?fields=id,brand_name&id=" + id, {
                data: '',
                dataType: "json",
                cache: true
            }).done(function(result) {
                var out = new Array;
                $(result.data).each(function(i, element) {
                    out.push({
                        'id': element.id,
                        'text': element.brand_name
                    });
                });
                if (out.length == 1) {
                    callback(out[0]);
                } else {
                    callback(out);
                }
            });
        }
    }
}).on("change", function() {
    $(".car,.variant").select2("val", "").trigger("change");
});

$(".car").select2({
    ajax: {
        url: function(term, page) {
            var url = web_root + "api/cars.json?fields=id,car_name&page=" + page + "&car_name=" + term;
            if ($("input.brand").length > 0) {
                url += "&brand=" + $("input.brand").val();
            }
            if ($("input.body_type").length > 0) {
                url += "&body=" + $("input.body_type").val();
            }
            return url;
        },
        dataType: 'json',
        cache: true,
        results: function(result, page) {
            var out = new Array;
            $(result.data).each(function(i, element) {
                out.push({
                    'id': element.id,
                    'text': element.car_name
                });
            });
            return {
                results: out,
                more: (result.pagination.has_next_page == true)
            };
        }
    },
    escapeMarkup: function(markup) {
        return markup;
    },
    initSelection: function(element, callback) {
        var id = $(element).val();
        if (id !== "") {
            $.ajax(web_root + "api/cars.json?fields=id,car_name&id=" + id, {
                data: '',
                dataType: "json",
                cache: true
            }).done(function(result) {
                var out = new Array;
                $(result.data).each(function(i, element) {
                    out.push({
                        'id': element.id,
                        'text': element.car_name
                    });
                });
                if (out.length == 1) {
                    callback(out[0]);
                } else {
                    callback(out);
                }
            });
        }
    }
}).on("change", function() {
    $(".variant").select2("val", "").trigger("change");
});

$(".variant").select2({
    ajax: {
        url: function(term, page) {
            var url = web_root + "api/variants.json?fields=id,variant_name&page=" + page + "&variant_name=" + term;
            if ($("input.car").length > 0) {
                url += "&car=" + $("input.car").val();
            }
            return url;
        },
        dataType: 'json',
        cache: true,
        results: function(result, page) {
            var out = new Array;
            $(result.data).each(function(i, element) {
                out.push({
                    'id': element.id,
                    'text': element.variant_name
                });
            });
            return {
                results: out,
                more: (result.pagination.has_next_page == true)
            };
        }
    },
    escapeMarkup: function(markup) {
        return markup;
    },
    initSelection: function(element, callback) {
        var id = $(element).val();
        if (id !== "") {
            $.ajax(web_root + "api/variants.json?fields=id,variant_name&id=" + id, {
                data: '',
                dataType: "json",
                cache: true
            }).done(function(result) {
                var out = new Array;
                $(result.data).each(function(i, element) {
                    out.push({
                        'id': element.id,
                        'text': element.variant_name
                    });
                });
                if (out.length == 1) {
                    callback(out[0]);
                } else {
                    callback(out);
                }
            });
        }
    }
}).on("change", function() {
    //$(".car,.variant").select2("val", "").trigger("change");
});

$('select').select2({});
