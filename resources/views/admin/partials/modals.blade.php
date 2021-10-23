{{-- confirm modal --}}
<div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert-warning">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Сигурен ли си?</h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Не</button>
                <button type="button" class="btn btn-primary btn-submit">Да</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal Playlist -->
<div class="modal fade" id="modal-datatable" role="dialog">
  <div class="modal-dialog"  role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Заглавие</h4>
      </div>
      <div class="modal-body">
        <table id="datatable" data-server="true" class="datatable table table-striped table-bordered responsive" cellspacing="5px" width="100%">
            <thead>
            <tr>
                <th>Заглавие</th>
                <th>Изображение</th>
                <th></th>
            </tr>
            </thead>
        </table>
      </div>
      <br>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="bulk_delete_from_playlist">Премахни от плейлистата</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Затвори</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->





<!-- Modal Player Settings Demo -->
<div class="modal fade" id="modal-showSettings" role="dialog">
  <div class="modal-dialog"  role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Заглавие</h4>
      </div>
      <div class="modal-body">
        <div class="media-wrapper">
          <div class="live-player" id="live-player" width="100%">
          </div>
        </div>
      </div>
      <br>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Затвори</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="modal-chosePlaylist" role="dialog">
  <div class="modal-dialog"  role="document">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header alert-success">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Заглавие</h4>
      </div>
      <div class="modal-body">
      </div>
      <br>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="bulk_delete_from_playlist">Постави</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Затвори</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->








{{-- notifications --}}
<div class="modal fade" id="modal-notifications" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Нотификации</h4>
            </div>
            <div class="modal-body">
                <table id="tbl-notifications" class="table table-striped table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th>Дата</th>
                        <th>Тип</th>
                        <th>Прочетана</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="3" class="text-center">В момента няма непрочетени нотификации</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Затвори</button>
            </div>
        </div>
    </div>
</div>
