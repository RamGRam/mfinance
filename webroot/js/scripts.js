$.getScript('http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.min.js', function () {
    /* Select2 for roadService by sundar*/
    $("#roadService").select2({
        minimumInputLength: 2,
    });

    /* Select2 for Brand_Model by sundar*/
    $("#BrandModel").select2({
        minimumInputLength: 2,
    });

    $("#country").select2({});
    $("#state").select2({});
    $("#city").select2({});
    $("#garage").select2({});
});


 
$(document).ready(function (){
    
    $("select").closest("form").on("reset",function(ev){
        var targetJQForm = $(ev.target);
        setTimeout((function(){
            this.find("select").trigger("change");
        }).bind(targetJQForm),0);
    });

       
    
    $('.form-focus :input:enabled:visible:first').focus();
    $('.form-focus :input.form-control.form-error:enabled:visible:first').focus();
}
);

$(document).ready(function () {
    $("select:not(#duallistbox)").select2({
        minimumResultsForSearch: -1
    });


 
    

    /*
     * Select2 for Garage
     */
    $(".center").select2({
        allowClear: true,
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {
                var url = web_root + "api/centers.json?fields=id,name&page=" + page + "&name=" + term;
                /*if ($("input.country").length > 0) {
                 url += "&country=" + $("input.country").val();
                 }*/

                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
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
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "api/centers.json?fields=id,name&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
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

    }).on("change", function () {
        
    });
    
    
    /*
     * Select2 for Customer
     */
    $(".customer").select2({
        allowClear: true,
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {
                var url = web_root + "api/users.json?fields=id,name&page=" + page + "&name=" + term;
                /*if ($("input.country").length > 0) {
                 url += "&country=" + $("input.country").val();
                 }*/

                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
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
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "api/users.json?fields=id,name&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
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

    }).on("change", function () {
        
    });

    /*
     * Select2 for Customer
     */
    $(".seatcustomer").select2({
        allowClear: true,
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {
                var url = web_root + "api/users/seatuser.json?fields=id,name&page=" + page + "&name=" + term;
                /*if ($("input.country").length > 0) {
                 url += "&country=" + $("input.country").val();
                 }*/

                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
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
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "api/users.json?fields=id,name&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
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

    }).on("change", function () {
        $(".seatdue").select2("val", "").trigger("change");
    });
    

    $(".staff").select2({
        allowClear: true,
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {
                var url = web_root + "api/staffs.json?fields=id,name&page=" + page + "&name=" + term;
                /*if ($("input.country").length > 0) {
                 url += "&country=" + $("input.country").val();
                 }*/

                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
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
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "api/staffs.json?fields=id,name&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
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

    }).on("change", function () {
        
    });

     


    /*
     * Select2 for group
     */
    $(".group").select2({
        allowClear: true,
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {
                var url = web_root + "api/groups.json?fields=id,name&page=" + page + "&name=" + term;
                /*if ($("input.country").length > 0) {
                 url += "&country=" + $("input.country").val();
                 }*/
                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
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
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "api/groups.json?fields=id,name&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
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
    }).on("change", function () {
        $(".price").select2("val", "").trigger("change");
    });


    $(".price").select2({
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {

                var url = web_root + "admin/groups/price?fields=id,name,loan_type1,loan_type2&page=" + page + "&name=" + term;
                if ($("input.group").length > 0) {
                    url += "&id=" + $("input.group").val();
                }
                
                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
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
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "admin/groups/price?fields=id,name,loan_type1,loan_type2&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
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
    });
    
    
    
    
    

    /*
     * Select2 for Bodytype master multiple
     */
    $(".loanList").select2({
        allowClear: true,
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {
                var url = web_root + "admin/loans/list?fields=id,name,uid&page=" + page + "&name=" + term;
                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
                   out.push({
                        'id': element.id,
                        'text': element.uid.toString()
                    });
                });
                return {
                    results: out,
                    more: (result.pagination.has_next_page == true)
                };
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "admin/loans/list?fields=id,name,uid&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
                        out.push({
                            'id': element.id,
                            'text': element.uid.toString()
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
    }).on("change", function () {
        $(".due").select2("val", "").trigger("change");
    });
    
    
    
    /*
     * Select2 for loan
     */
    $(".loan").select2({
        allowClear: true,
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {
                var url = web_root + "api/loans.json?fields=id,uid&page=" + page + "&name=" + term;
                /*if ($("input.country").length > 0) {
                 url += "&country=" + $("input.country").val();
                 }*/
                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
                    out.push({
                        'id': element.id,
                        'text': element.uid
                    });
                });
                return {
                    results: out,
                    more: (result.pagination.has_next_page == true)
                };
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "api/loans.json?fields=id,uid&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
                        out.push({
                            'id': element.id,
                            'text': element.uid
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
    }).on("change", function () {
        $(".price").select2("val", "").trigger("change");
    });
    
    
        /*
     * Select2 for loan
     */
    $(".closed_loan").select2({
        allowClear: true,
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {
                var url = web_root + "api/loans/closed?fields=id,uid&page=" + page + "&name=" + term;
                /*if ($("input.country").length > 0) {
                 url += "&country=" + $("input.country").val();
                 }*/
                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
                    out.push({
                        'id': element.id,
                        'text': element.uid.toString()
                    });
                });
                return {
                    results: out,
                    more: (result.pagination.has_next_page == true)
                };
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "api/loans.json?fields=id,uid&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
                        out.push({
                            'id': element.id,
                            'text': element.uid.toString()
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
    }).on("change", function () {
        $(".price").select2("val", "").trigger("change");
    });
    
    
       /*
     * Select2 for seat
     */
    $(".closed_seat").select2({
        allowClear: true,
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {
                var url = web_root + "api/seats/closed?fields=id,title&page=" + page + "&name=" + term;
                /*if ($("input.country").length > 0) {
                 url += "&country=" + $("input.country").val();
                 }*/
                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
                    out.push({
                        'id': element.id,
                        'text': element.id.toString()
                    });
                });
                return {
                    results: out,
                    more: (result.pagination.has_next_page == true)
                };
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "api/seats/closed?fields=id,id&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
                        out.push({
                            'id': element.id,
                            'text': element.id.toString()
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
    }).on("change", function () {
        
    });


  
      $(".due").select2({
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {

                var url = web_root + "admin/loans/due?fields=id,name&page=" + page + "&name=" + term;
                if ($("input.loanList").length > 0) {
                    url += "&id=" + $("input.loanList").val();
                }
                
                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
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
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "admin/loans/due?fields=id,name,&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
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
    });
    
    
    $(".seatList").select2({
        allowClear: true,
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {
                var url = web_root + "api/seats.json?fields=id&page=" + page + "&id=" + term;
                /*if ($("input.country").length > 0) {
                 url += "&country=" + $("input.country").val();
                 }*/

                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
                    out.push({
                        'id': element.id,
                        'text': element.id.toString()
                    });
                });
                return {
                    results: out,
                    more: (result.pagination.has_next_page == true)
                };
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "api/seats.json?fields=id&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
                        out.push({
                            'id': element.id,
                            'text': element.id.toString()
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

    }).on("change", function () {
        
    });
    

    $(".seatdue").select2({
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {

                var url = web_root + "admin/seats/seatdue?fields=id,name&page=" + page + "&name=" + term;
                if ($("input.seatcustomer").length > 0) {
                    url += "&id=" + $("input.seatcustomer").val();
                }
                
                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
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
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "admin/seats/seatdue?fields=id,name,&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
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
    });
    
    /*
     * Select2 for City
     */
    $(".city").select2({
        allowClear: true,
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {
                var url = web_root + "api/cities.json?fields=id,name&page=" + page + "&name=" + term;
                /*if ($("input.country").length > 0) {
                 url += "&country=" + $("input.country").val();
                 }*/
                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
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
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "api/cities.json?fields=id,name&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
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
    }).on("change", function () {
        //$(".mechanic").select2("val", "").trigger("change");
    });


    /*
     * Select2 for Garage
     */
    $(".garage").select2({
        allowClear: true,
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {
                var url = web_root + "api/garages.json?fields=id,garage_name&page=" + page + "&name=" + term;
                /*if ($("input.country").length > 0) {
                 url += "&country=" + $("input.country").val();
                 }*/

                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
                    out.push({
                        'id': element.id,
                        'text': element.garage_name
                    });
                });
                return {
                    results: out,
                    more: (result.pagination.has_next_page == true)
                };
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "api/garages.json?fields=id,garage_name&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
                        out.push({
                            'id': element.id,
                            'text': element.garage_name
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
 
    }).on("change", function () {
        $(".mechanic").select2("val", "").trigger("change");
    });


 

    $(".mechanic").select2({
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {

                var dtype = isNaN(term);
                
                if (dtype == true || term=='')
                {
                    var url = web_root + "api/mechanics.json?fields=id,first_name,last_name,contact_no&page=" + page + "&name=" + term;
                }
                else
                {
                    var url = web_root + "api/mechanics.json?fields=id,first_name,last_name,contact_no&page=" + page + "&contact_no=" + term;
                }
                if ($("input.garage").length > 0) {
                    url += "&garage_id=" + $("input.garage").val();
                }
              
                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
                    out.push({
                        'id': element.id,
                        'text': element.first_name+' '+element.last_name+ '/' + element.contact_no
                    });
                });
                return {
                    results: out,
                    more: (result.pagination.has_next_page == true)
                };
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            
            if (id !== "") {
                $.ajax(web_root + "api/mechanics.json?fields=id,first_name,last_name,contact_no&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
                        out.push({
                            'id': element.id,
                            'text': element.first_name
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
    });





    /*
     * Select2 for brand
     */
    $(".brand").select2({
        allowClear: true,
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {
                var url = web_root + "api/brands.json?fields=id,brand_name&page=" + page + "&name=" + term;
                /*if ($("input.country").length > 0) {
                 url += "&country=" + $("input.country").val();
                 }*/
                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
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
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "api/brands.json?fields=id,brand_name&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
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
    }).on("change", function () {
        $(".model").select2("val", "").trigger("change");
    });

 

    $(".model").select2({
        ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
            url: function (term, page) {

                var url = web_root + "api/vehicle_models.json?fields=id,model_name&page=" + page + "&name=" + term;
                if ($("input.brand").length > 0) {
                    url += "&brand_id=" + $("input.brand").val();
                }

                return url;
            },
            dataType: 'json',
            cache: true,
            results: function (result, page) {
                var out = new Array;
                $(result.data).each(function (i, element) {
                    out.push({
                        'id': element.id,
                        'text': element.model_name
                    });
                });
                return {
                    results: out,
                    more: (result.pagination.has_next_page == true)
                };
            }
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        initSelection: function (element, callback) {
            var id = $(element).val();
            if (id !== "") {
                $.ajax(web_root + "api/vehicle_models.json?fields=id,model_name&id=" + id, {
                    data: '',
                    dataType: "json",
                    cache: true
                }).done(function (result) {
                    var out = new Array;
                    $(result.data).each(function (i, element) {
                        out.push({
                            'id': element.id,
                            'text': element.model_name
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
    });

  
 

});

$(".service_type").select2({
    allowClear: true,
    ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
        url: function (term, page) {
            var url = web_root + "api/service_types.json?fields=id,service_type&page=" + page + "&service_type=" + term;
            /*if ($("input.country").length > 0) {
             url += "&country=" + $("input.country").val();
             }*/
            return url;
        },
        dataType: 'json',
        cache: true,
        results: function (result, page) {
            var out = new Array;
            $(result.data).each(function (i, element) {
                out.push({
                    'id': element.id,
                    'text': element.service_type
                });
            });
            return {
                results: out,
                more: (result.pagination.has_next_page == true)
            };
        }
    },
    escapeMarkup: function (markup) {
        return markup;
    },
    initSelection: function (element, callback) {
        var id = $(element).val();
        if (id !== "") {
            $.ajax(web_root + "api/service_types.json?fields=id,service_type&id=" + id, {
                data: '',
                dataType: "json",
                cache: true
            }).done(function (result) {
                var out = new Array;
                $(result.data).each(function (i, element) {
                    out.push({
                        'id': element.id,
                        'text': element.service_type
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
}).on("change", function () {
    //$(".model").select2("val", "");                    
});
$(".kilometer").select2({
    allowClear: true,
    ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
        url: function (term, page) {
            var url = web_root + "api/kilometers.json?fields=id,kilometer&page=" + page + "&kilometer=" + term;
            /*if ($("input.country").length > 0) {
             url += "&country=" + $("input.country").val();
             }*/
            return url;
        },
        dataType: 'json',
        cache: true,
        results: function (result, page) {
            var out = new Array;
            $(result.data).each(function (i, element) {
                out.push({
                    'id': element.id,
                    'text': element.kilometer
                });
            });
            return {
                results: out,
                more: (result.pagination.has_next_page == true)
            };
        }
    },
    escapeMarkup: function (markup) {
        return markup;
    },
    initSelection: function (element, callback) {
        var id = $(element).val();
        if (id !== "") {
            $.ajax(web_root + "api/kilometers.json?fields=id,kilometer&id=" + id, {
                data: '',
                dataType: "json",
                cache: true
            }).done(function (result) {
                var out = new Array;
                $(result.data).each(function (i, element) {
                    out.push({
                        'id': element.id,
                        'text': element.kilometer
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
}).on("change", function () {
    // $(".model").select2("val", "");                    
});
$(".auto_spare").select2({
    allowClear: true,
    ajax: {// instead of writing the function to execute the request we use Select2's convenient helper
        url: function (term, page) {
            var url = web_root + "api/auto_spares.json?fields=id,spare_name&page=" + page + "&spare_name=" + term;
            /*if ($("input.country").length > 0) {
             url += "&country=" + $("input.country").val();
             }*/
            return url;
        },
        dataType: 'json',
        cache: true,
        results: function (result, page) {
            var out = new Array;
            $(result.data).each(function (i, element) {
                out.push({
                    'id': element.id,
                    'text': element.spare_name
                });
            });
            return {
                results: out,
                more: (result.pagination.has_next_page == true)
            };
        }
    },
    escapeMarkup: function (markup) {
        return markup;
    },
    initSelection: function (element, callback) {
        var id = $(element).val();
        if (id !== "") {
            $.ajax(web_root + "api/auto_spares.json?fields=id,spare_name&id=" + id, {
                data: '',
                dataType: "json",
                cache: true
            }).done(function (result) {
                var out = new Array;
                $(result.data).each(function (i, element) {
                    out.push({
                        'id': element.id,
                        'text': element.spare_name
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
}).on("change", function () {
    //$(".model").select2("val", "");                    
});


// for filter icon change when click
$('.collapsed').click(function () {
    $(this).find('i').toggleClass('fa fa-chevron-up fa fa-chevron-down')
});
$('.dateTime').datetimepicker();

var demo2 = $('#duallistbox').bootstrapDualListbox({
    nonSelectedListLabel: 'Non-selected',
    selectedListLabel: 'Selected',
    moveOnSelect: false

});

