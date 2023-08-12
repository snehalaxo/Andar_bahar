<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>User</th>
                            <th>Card 1</th>
                            <th>Card 2</th>
                            <th>Card 3</th>
                            <th>Packed</th>
                            <th>Seen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($AllGame as $key => $Game) {
                            $i++;
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $Game->name ?></td>
                                <td><img src="<?= base_url('data/cards/' . strtolower($Game->card1) . '.png'); ?>""><button class=" form-control" onclick="FetchCards('<?= $Game->game_id ?>','<?= $Game->user_id ?>','card1')">Change</button></td>
                                <td><img src="<?= base_url('data/cards/' . strtolower($Game->card2) . '.png'); ?>""><button class=" form-control" onclick="FetchCards('<?= $Game->game_id ?>','<?= $Game->user_id ?>','card2')">Change</button></td>
                                <td><img src="<?= base_url('data/cards/' . strtolower($Game->card3) . '.png'); ?>""><button class=" form-control" onclick="FetchCards('<?= $Game->game_id ?>','<?= $Game->user_id ?>','card3')">Change</button></td>
                                <td><?= ($Game->packed) ? 'yes' : 'no'; ?></td>
                                <td><?= ($Game->seen) ? 'yes' : 'no'; ?></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end col -->

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Card</h4>
                </div>
                <div class="modal-body">

                    <div class="modal-body">
                        <div id="IMG"></div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        setTimeout(function() {
            location.reload()
        }, 5000);

        function FetchCards(Game_id, User_id, Position) {
            $("#myModal").modal()
            var data = {
                Game_id: Game_id,
                User_id: User_id,
                Position: Position,
            }
            jQuery.ajax({
                type: 'POST',
                url: BASE_URL + 'backend/Table/VacantCards',
                data: data,
                beforeSend: function() {},
                success: function(data) {
                    if (data) {
                        var obj = JSON.parse(data)
                        // alert(obj)
                        $.each(obj, function(k, value) {
                            var name = value.toLowerCase()
                            var Src = BASE_URL + 'data/cards/' + value.toLowerCase() + '.png'
                            // alert(Src)
                            $('#IMG').prepend('<img id="theImg" src="' + Src + '" onclick="Change(\'' + value + '\',' + Game_id + ',' + User_id + ',\'' + Position + '\')"/>')
                        });
                    }
                },
                error: function(e) {}
            })
        }

        function Change(name, Game_id, User_id, Position) {
            var data = {
                name: name,
                Game_id: Game_id,
                User_id: User_id,
                Position: Position,
            }
            //= ========ajax==========//
            jQuery.ajax({
                type: 'POST',
                url: BASE_URL + 'backend/Table/ChangeCard',
                data: data,
                beforeSend: function() {},
                success: function(response) {
                    alert('Card Changed Successfully')
                    setTimeout(function() {
                        location.reload()
                    }, 1000)
                },
                error: function(e) {}
            })
        }
    </script>