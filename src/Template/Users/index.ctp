<div
  id="data-ajax-url-list"
  data-ajax-post-micropost-url="<?php echo $this->Url->build(['controller' => 'ajax','action' => 'addMicropost']);?>"
  data-ajax-show-micropost-url="<?php echo $this->Url->build(['controller' => 'ajax','action' => 'showMicropost']);?>"
  data-ajax-post-replay-url="<?php echo $this->url->build(['controller' => 'ajax','action' =>'addReplay']);?>"
  data-user-id = "<?php echo h($currentUserRow->getId()); ?>"
>

</div>
<div class="row">

	<div id="user-info" class="col-md-3">
		<div class="user-profile col-xs-12">
			<div></div>
			<div class="col-xs-6 user-image">
				<p style="font-size: 80px;"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></p>
			</div>
			<div class="col-xs-6 user-name">
				<p style="font-size: 20px;"><?php echo h($currentUserRow->getName());?></p>
			</div>
		</div>
		<div class="user-info-link col-xs-12">
			<span class="col-xs-4">
				<a href="#">
					ツイート
				</a>
			</span>
			<span class="col-xs-4">
				<a href="#">
					フォロー
				</a>
			</span>
			<span class="col-xs-4">
				<a href="#">
					フォロワー
				</a>
			</span>
		</div>
	</div>
	<div id="micropost" class="col-md-8 col-md-offset-1">

		<div id="js-micropost-form" class="micropost-form-space bg-warning">
				<div class="micropost-form-image col-xs-1" style="font-size: 30px;"><span class="glyphicon glyphicon-user" aria-hidden="true"></div>
				<div id="js-micopost-create-form" class="input-group col-xs-11">
					<input  id="js-micropost-text-form" type="text" name="micropost" placeholder="つぶやく" class="form-control">
				</div>
				<div id="micropost-form-bottom" class="text-right" style="display: none">
					<button type="button" class="submit-micropost btn btn-warning" disabled="true" >投稿</button>
				</div>
		</div>

		<div id="ovarall-micropost-space">
        <?php if(!empty($MicropostRowset)): ?>
          <?php foreach($MicropostRowset as $MicropostRow): ?>
    				<div class="each-paginate-micropost-space">
    						<div
                  data-toggle="modal"
                  data-micropost-id="<?php echo h($MicropostRow->getId());?>"
                  class="each-micropost-space each-micropost-border"
                  data-recipient="<?php echo h($MicropostRow->getUserName());?>"
                  data-user-id="<?php echo h($MicropostRow->getUserId());?>"
                >
    							<div class="micropost-content-space">
    								<div class="micropost-user-info">
    									<p><span class="glyphicon glyphicon-user" aria-hidden="true"></span><?php echo h($currentUserRow->getName());?></p>
    								</div>
    								<div class="micropost-content" >
    									<p>
    									   <?php echo h($MicropostRow->getContent()); ?>
    									</p>
    								</div>
    							</div>
    				</div>
          <?php endforeach; ?>
      <?php endif; ?>
		</div>
	</div>
</div>
<?php echo $this->element('modal'); ?>
