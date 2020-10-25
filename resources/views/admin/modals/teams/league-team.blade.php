<div class="modal fade" id="add-league-team" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['method'=>'post','id'=>'add-team-league-frm']) !!}

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">الفرق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
{{--                <button type="submit" class="btn btn-primary save">اضافة الفرق</button>--}}

            </div>
            <div class="modal-body">
                <input type="hidden" name="league_id" id="league_id" value="{{$league->id}}">
                <table class="m-datatable" id="teams_table_select" width="100%">
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                <button type="submit" class="btn btn-primary save">اضافة الفرق</button>

            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>


<script>
    $(document).ready(function () {

        var teams_table_select = $('#teams_table_select').mDatatable({
            data: {
                // saveState: {
                //     cookie: true,
                //     webstorage: true
                // },
                type: 'remote',
                source: {
                    read: {
                        url: baseURL + '/leagues/teams-not-league-data',
                        method: 'GET',
                        // custom headers
                        headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                        params: {
                            // custom parameters
                            // generalSearch: '',
                            league_id: $('#league_id').val(),
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
                pageSize: 1000,
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },
            pagination: true,
            search: {
                input: $('#teams_table_select_search')
            },
            columns: [
                {
                    field: "id",
                    // sortable: false,
                    // width: 40,
                    // textAlign: 'center',
                    name: 'teams_id[]',
                    title: 'id',
                    selector: {class: 'm-checkbox--solid m-checkbox--brand'},
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
                },
            ]
        });
        
    });

</script>

