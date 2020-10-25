//== Class definition
var users_list, users_list2, users_list3, teams_table, league_teams_table, pitches_table, leagues_upcoming_table,
    leagues_current_table,
    teams_table_select,
    league_groups_table,
    stats_table,
    result_types_table,
    positions_table,
    articles_table,
    matches_upcoming_table,
    matches_current_table,
    matches_completed_table,
    leagues_completed_table;
var DatatableHtmlTableDemo = function () {
    //== Private functions

    // demo initializer
    var demo = function () {

        matches_upcoming_table = $('#matches_upcoming_table').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/matches/match-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            // EmployeeID: 1,
                            status: 'new',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#matches_upcoming_table_search')
            },
            columns: [
                {
                    field: "DT_RowIndex",
                    title: "#",
                    width: 40,
                }, {
                    field: "type",
                    title: "النوع",
                    width: 100,
                }, {
                    field: "team_one_name",
                    title: "الفريق الاول",
                    width: 100,
                }, {
                    field: "team_two_name",
                    title: "الفريق الثاني",
                    width: 100,
                }, {
                    field: "city_name",
                    title: "المدينة",
                    width: 100,
                }, {
                    field: "match_date_time",
                    title: "تاريخ البداية",
                    width: 100,
                }, {
                    field: "league_name",
                    title: "البطولة",
                    width: 70,
                }, {
                    field: "pitch_name",
                    title: "الملعب",
                    width: 70,
                }, {
                    field: "group_name",
                    title: "المجموعة",
                    width: 70,
                }, {
                    field: "team_one_result",
                    title: "نتيجة الاول",
                    width: 70,
                }, {
                    field: "team_two_result",
                    title: "نتيجة الثاني",
                    width: 70,
                }, {
                    field: "level",
                    title: "الجولة",
                    width: 70,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 130,
                },
            ]
        });
        matches_current_table = $('#matches_current_table').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/matches/match-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            // EmployeeID: 1,
                            status: 'current',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#matches_current_table_search')
            },
            columns: [
                {
                    field: "DT_RowIndex",
                    title: "#",
                    width: 40,
                }, {
                    field: "type",
                    title: "النوع",
                    width: 100,
                }, {
                    field: "team_one_name",
                    title: "الفريق الاول",
                    width: 100,
                }, {
                    field: "team_two_name",
                    title: "الفريق الثاني",
                    width: 100,
                }, {
                    field: "city_name",
                    title: "المدينة",
                    width: 100,
                }, {
                    field: "match_date_time",
                    title: "تاريخ البداية",
                    width: 100,
                }, {
                    field: "league_name",
                    title: "البطولة",
                    width: 70,
                }, {
                    field: "pitch_name",
                    title: "الملعب",
                    width: 70,
                }, {
                    field: "group_name",
                    title: "المجموعة",
                    width: 70,
                }, {
                    field: "team_one_result",
                    title: "نتيجة الاول",
                    width: 70,
                }, {
                    field: "team_two_result",
                    title: "نتيجة الثاني",
                    width: 70,
                }, {
                    field: "level",
                    title: "الجولة",
                    width: 70,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 130,
                },
            ]
        });
        matches_completed_table = $('#matches_completed_table').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/matches/match-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            // EmployeeID: 1,
                            status: 'finished',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#matches_completed_table_search')
            },
            columns: [
                {
                    field: "DT_RowIndex",
                    title: "#",
                    width: 40,
                }, {
                    field: "type",
                    title: "النوع",
                    width: 100,
                }, {
                    field: "team_one_name",
                    title: "الفريق الاول",
                    width: 100,
                }, {
                    field: "team_two_name",
                    title: "الفريق الثاني",
                    width: 100,
                }, {
                    field: "city_name",
                    title: "المدينة",
                    width: 100,
                }, {
                    field: "match_date_time",
                    title: "تاريخ البداية",
                    width: 100,
                }, {
                    field: "league_name",
                    title: "البطولة",
                    width: 70,
                }, {
                    field: "pitch_name",
                    title: "الملعب",
                    width: 70,
                }, {
                    field: "group_name",
                    title: "المجموعة",
                    width: 70,
                }, {
                    field: "team_one_result",
                    title: "نتيجة الاول",
                    width: 70,
                }, {
                    field: "team_two_result",
                    title: "نتيجة الثاني",
                    width: 70,
                }, {
                    field: "level",
                    title: "الجولة",
                    width: 70,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 130,
                },
            ]
        });

        users_list = $('#users_list').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/users/admin-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            // EmployeeID: 1,
                            // someParam: 'someValue',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#users_list_search')
            },
            columns: [
                {
                    field: "DT_RowIndex",
                    title: "#",
                    width: 40,
                }, {
                    field: "logo",
                    title: "الصورة",
                    width: 90,
                }, {
                    field: "username",
                    title: "اسم المستخدم",
                    width: 130,
                }, {
                    field: "email",
                    title: "البريد الالكتروني",
                    width: 150,
                }, {
                    field: "mobile",
                    title: "رقم الجوال",
                    width: 100,
                }, {
                    field: "is_active",
                    title: "الحالة/فعال",
                    width: 100,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 100,
                },
            ]
        });
        users_list2 = $('#users_list2').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/users/user-data/pitch_owner',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            // EmployeeID: 1,
                            // someParam: 'someValue',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#users_list2_search')
            },
            columns: [
                {
                    field: "DT_RowIndex",
                    title: "#",
                    width: 40,
                }, {
                    field: "image",
                    title: "الصورة",
                    width: 80,
                }, {
                    field: "full_name",
                    title: "الإسم",
                    width: 100,
                }, {
                    field: "username",
                    title: "اسم المستخدم",
                    width: 100,
                }, {
                    field: "email",
                    title: "البريد الالكتروني",
                    width: 150,
                }, {
                    field: "mobile",
                    title: "رقم الجوال",
                    width: 80,
                }, {
                    field: "city.resource.name",
                    title: "المدينة",
                    width: 100,
                }, {
                    field: "address",
                    title: "العنوان",
                    width: 100,
                }, {
                    field: "is_active",
                    title: "الحالة/فعال",
                    width: 100,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 80,
                },
            ]
        });
        users_list3 = $('#users_list3').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/users/user-data/player',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            // EmployeeID: 1,
                            // someParam: 'someValue',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#users_list3_search')
            },
            columns: [
                {
                    field: "DT_RowIndex",
                    title: "#",
                    width: 40,
                }, {
                    field: "image",
                    title: "الصورة",
                    width: 80,
                }, {
                    field: "full_name",
                    title: "الإسم",
                    width: 100,
                }, {
                    field: "username",
                    title: "اسم المستخدم",
                    width: 100,
                }, {
                    field: "email",
                    title: "البريد الالكتروني",
                    width: 150,
                }, {
                    field: "mobile",
                    title: "رقم الجوال",
                    width: 80,
                }, {
                    field: "city.resource.name",
                    title: "المدينة",
                    width: 100,
                }, {
                    field: "address",
                    title: "العنوان",
                    width: 100,
                }, {
                    field: "is_active",
                    title: "الحالة/فعال",
                    width: 100,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 80,
                },
            ]
        });

        var booking_list = $('#booking_list').mDatatable({
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#booking_search')
            },
        });
        var booking_list2 = $('#booking_list2').mDatatable({
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#booking_search2')
            },
        });
        var booking_list3 = $('#booking_list3').mDatatable({
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#booking_search3')
            },
        });
        stats_table = $('#stats_table').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/settings/stats/stats-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            // EmployeeID: 1,
                            // someParam: 'someValue',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#stats_table_search')
            },
            columns: [
                {
                    field: "DT_RowIndex",
                    title: "#",
                    width: 40,
                }, {
                    field: "name",
                    title: "نوع الاحصائية",
                    width: 130,
                }, {
                    field: "is_active",
                    title: "الحالة",
                    width: 100,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 130,
                },
            ]
        });
        positions_table = $('#positions_table').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/settings/positions/positions-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            // EmployeeID: 1,
                            // someParam: 'someValue',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#position_table_search')
            },
            columns: [
                {
                    field: "DT_RowIndex",
                    title: "#",
                    width: 40,
                }, {
                    field: "title",
                    title: "إسم المركز",
                    width: 130,
                }, {
                    field: "name",
                    title: "اختصار المركز",
                    width: 130,
                }, {
                    field: "is_active",
                    title: "الحالة",
                    width: 100,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 130,
                },
            ]
        });
        result_types_table = $('#result_types_table').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/settings/results/results-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            // EmployeeID: 1,
                            // someParam: 'someValue',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#result_types_table_search')
            },
            columns: [
                {
                    field: "DT_RowIndex",
                    title: "#",
                    width: 40,
                }, {
                    field: "name",
                    title: "نوع النتيجة",
                    width: 130,
                }, {
                    field: "is_active",
                    title: "الحالة",
                    width: 100,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 130,
                },
            ]
        });
        articles_table = $('#articles_table').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/articles/articles-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            // EmployeeID: 1,
                            // someParam: 'someValue',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#articles_table_search')
            },
            columns: [
                {
                    field: "DT_RowIndex",
                    title: "#",
                    width: 40,
                }, {
                    field: "media",
                    title: "الصورة / الفيديو",
                    width: 130,
                }, {
                    field: "title",
                    title: "العنوان",
                    width: 130,
                }, {
                    field: "published_date",
                    title: "التاريخ",
                    width: 130,
                }, {
                    field: "is_active",
                    title: "الحالة",
                    width: 100,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 130,
                },
            ]
        });

        // var articles_table = $('#articles_table').mDatatable({
        //     data: {
        //         saveState: {cookie: false},
        //     },
        //     search: {
        //         input: $('#articles_search')
        //     },
        //     columns: [
        //         {
        //             field: "Id",
        //             title: "#",
        //             width: 40,
        //         },
        //         {
        //             field: "Media",
        //             width: 90,
        //         },
        //         {
        //             field: "Title",
        //             width: 300,
        //         },
        //     ]
        // });
        var transactions_table = $('#transactions_table').mDatatable({
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#transaction_search')
            },
            columns: [
                {
                    field: "Id",
                    title: "#",
                    width: 40,
                },
            ]
        });
        /*var teams_table = $('#teams_table').mDatatable({
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#teams_search')
            },
            columns: [
                {
                    field: "Logo",
                    width: 60,
                },
            ]
        });
*/
        teams_table = $('#teams_table').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/teams/team-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            // EmployeeID: 1,
                            // someParam: 'someValue',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#teams_search')
            },
            columns: [
                {
                    field: "DT_RowIndex",
                    title: "#",
                    width: 40,
                }, {
                    field: "logo",
                    title: "الشعار",
                    width: 100,
                }, {
                    field: "name",
                    title: "إسم الفريق",
                    width: 100,
                }, {
                    field: "city_name",
                    title: "المدينة",
                    width: 100,
                }, {
                    field: "player_num",
                    title: "عدد اللاعبين",
                    width: 100,
                }, {
                    field: "captain.resource.full_name",
                    title: "الكابتن",
                    width: 200,
                }, {
                    field: "coach.resource.full_name",
                    title: "المدرب",
                    width: 70,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 130,
                },
            ]
        });
        league_teams_table = $('#league_teams_table').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/teams/team-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            league_id: $('#league_id').val(),
                            // someParam: 'someValue',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#league_teams_search')
            },
            columns: [
                {
                    field: "DT_RowIndex",
                    title: "#",
                    width: 40,
                }, {
                    field: "logo",
                    title: "الشعار",
                    width: 100,
                }, {
                    field: "name",
                    title: "إسم الفريق",
                    width: 100,
                }, {
                    field: "city_name",
                    title: "المدينة",
                    width: 100,
                }, {
                    field: "player_num",
                    title: "عدد اللاعبين",
                    width: 100,
                }, {
                    field: "captain.resource.full_name",
                    title: "الكابتن",
                    width: 70,
                }, {
                    field: "coach.resource.full_name",
                    title: "المدرب",
                    width: 70,
                }, {
                    field: "status_action",
                    title: "قبول/مغادرة",
                    width: 100,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 130,
                },
            ]
        });
        league_groups_table = $('#league_groups_table').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/groups/league-group-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            league_id: $('#league_id').val(),
                            // someParam: 'someValue',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#league_groups_search')
            },
            columns: [
                {
                    field: "DT_RowIndex",
                    title: "#",
                    width: 40,
                }, {
                    field: "team_name",
                    title: "الشعار",
                    width: 100,
                }, {
                    field: "pm",
                    title: "MP",
                    width: 100,
                }, {
                    field: "w",
                    title: "W",
                    width: 100,
                }, {
                    field: "d",
                    title: "D",
                    width: 100,
                }, {
                    field: "l",
                    title: "L",
                    width: 70,
                }, {
                    field: "gf",
                    title: "GF",
                    width: 70,
                }, {
                    field: "ga",
                    title: "GA",
                    width: 100,
                }, {
                    field: "gd",
                    title: "GD",
                    width: 70,
                }, {
                    field: "pts",
                    title: "Pts",
                    width: 100,
                },
            ]
        });

        // var groups_table = $('#groups_table').mDatatable({
        //     data: {
        //         saveState: {cookie: false},
        //     },
        //     search: {
        //         input: $('#groups_search')
        //     },
        //     columns: [
        //         {
        //             field: "ID",
        //             width: 40,
        //         },
        //     ]
        // });
        var teams_stats = $('#teams_stats').mDatatable({
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#teams_stats_search')
            },
            columns: [
                {
                    field: "ID",
                    width: 40,
                },
            ]
        });
        var players_stats = $('#players_stats').mDatatable({
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#players_stats_search')
            },
            columns: [
                {
                    field: "ID",
                    width: 40,
                },
            ]
        });
        /*var teams_table_select = $('#teams_table_select').mDatatable({
            data: {
                saveState: {cookie: false},
            },
            search: {
                input: $('#teams_search_select')
            },
            columns: [
                {
                    field: "Selection",
                    sortable: false,
                    width: 40,
                    textAlign: 'center',
                    selector: {class: 'm-checkbox--solid m-checkbox--brand'},
                },
                {
                    field: "Logo",
                    width: 60,
                },
            ]
        });*/

        leagues_upcoming_table = $('#leagues_upcoming_table').mDatatable({

            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/leagues/league-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            // EmployeeID: 1,
                            status: 'new',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#leagues_upcoming_table_search')
            },
            columns: [
                {
                    field: "logo",
                    title: "الشعار",
                    width: 100,
                }, {
                    field: "name",
                    title: "اسم البطولة",
                    width: 100,
                }, {
                    field: "type",
                    title: "النوع",
                    width: 100,
                }, {
                    field: "city_name",
                    title: "المدينة",
                    width: 100,
                }, {
                    field: "date_from",
                    title: "تاريخ البداية",
                    width: 150,
                }, {
                    field: "date_to",
                    title: "تاريخ النهاية",
                    width: 150,
                }, {
                    field: "teams_no",
                    title: "عدد الفرق",
                    width: 70,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 130,
                },
            ]
        });
        leagues_current_table = $('#leagues_current_table').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/leagues/league-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            // EmployeeID: 1,
                            status: 'current',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#leagues_current_table_search')
            },
            columns: [
                {
                    field: "logo",
                    title: "الشعار",
                    width: 100,
                }, {
                    field: "name",
                    title: "اسم البطولة",
                    width: 100,
                }, {
                    field: "type",
                    title: "النوع",
                    width: 100,
                }, {
                    field: "city_name",
                    title: "المدينة",
                    width: 100,
                }, {
                    field: "date_from",
                    title: "تاريخ البداية",
                    width: 150,
                }, {
                    field: "date_to",
                    title: "تاريخ النهاية",
                    width: 150,
                }, {
                    field: "teams_no",
                    title: "عدد الفرق",
                    width: 70,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 130,
                },
            ]
        });
        leagues_completed_table = $('#leagues_completed_table').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/leagues/league-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            // EmployeeID: 1,
                            status: 'finished',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#leagues_completed_table_search')
            },
            columns: [
                {
                    field: "logo",
                    title: "الشعار",
                    width: 100,
                }, {
                    field: "name",
                    title: "اسم البطولة",
                    width: 100,
                }, {
                    field: "type",
                    title: "النوع",
                    width: 100,
                }, {
                    field: "city_name",
                    title: "المدينة",
                    width: 100,
                }, {
                    field: "date_from",
                    title: "تاريخ البداية",
                    width: 150,
                }, {
                    field: "date_to",
                    title: "تاريخ النهاية",
                    width: 150,
                }, {
                    field: "teams_no",
                    title: "عدد الفرق",
                    width: 70,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 130,
                },
            ]
        });

        pitches_table = $('#pitches_table').mDatatable({
            data: {
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/pitches/pitch-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            // EmployeeID: 1,
                            // someParam: 'someValue',
                            token: csrf_token
                        },
                        map: function (raw) {
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;
                            }
                            return dataSet;
                        },
                    }
                },
                pageSize: 10,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#pitches_table_search')
            },
            columns: [
                {
                    field: "DT_RowIndex",
                    title: "#",
                    width: 40,
                }, {
                    field: "image",
                    title: "الصورة",
                    width: 100,
                }, {
                    field: "name",
                    title: "إسم الملعب",
                    width: 100,
                }, {
                    field: "owner.full_name",
                    title: "مالك الملعب",
                    width: 100,
                }, {
                    field: "city_name",
                    title: "المدينة",
                    width: 100,
                }, {
                    field: "address",
                    title: "العنوان",
                    width: 200,
                }, {
                    field: "name",
                    title: "عدد الملاعب",
                    width: 70,
                }, {
                    field: "cost_hour",
                    title: "السعر/ساعة (ريال سعودي)",
                    width: 70,
                }, {
                    field: "rates",
                    title: "التقييم",
                    width: 70,
                }, {
                    field: "action",
                    title: "إعدادات",
                    width: 130,
                },
            ]
        });


        $('#filter_date_from, #filter_date_to').on('change', function () {
            transactions_table.search($(this).val(), 'Date');
        });
        $('#filter_owner').on('change', function () {
            transactions_table.search($(this).val(), 'PitcheOwner');
        });
        $('#filter_transaction_type').on('change', function () {
            transactions_table.search($(this).val(), 'TransactionType');
        });
        $('#filter_payment_type').on('change', function () {
            transactions_table.search($(this).val(), 'PaymentType');
        });
        $('#filter_owner, #filter_transaction_type, #filter_payment_type').selectpicker();
    };

    return {
        //== Public functions
        init: function () {
            // init dmeo
            demo();
        },
    };
}();

jQuery(document).ready(function () {
    DatatableHtmlTableDemo.init();
});
