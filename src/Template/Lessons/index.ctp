<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>PHP基礎</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
        <a href="<?php echo $this->Url->build(['controller' => 'bases','action' => 'base1']); ?>">
          PHP基礎1
        </a>
      </td>
		</tr>
    <tr>
			<td>
        <a href="<?php echo $this->Url->build(['controller' => 'bases','action' => 'base2']); ?>">
          PHP基礎2
        </a>
      </td>
		</tr>
    <tr>
      <td>
        <a href="<?php echo $this->Url->build(['controller' => 'bases','action' => 'base3']); ?>">
          PHP基礎3
        </a>
      </td>
		</tr>
    <tr>
      <td>
        <a href="<?php echo $this->Url->build(['controller' => 'bases','action' => 'base4']); ?>">
          PHP基礎4
        </a>
      </td>
		</tr>
	</tbody>
</table>

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>レッスン</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
        <a href="<?php echo $this->Url->build(['controller' => 'lessons','action' =>'lesson0']); ?>">
          DBの用意
        </a>
      </td>
		</tr>
		<tr>
			<td>
        <a href="<?php echo $this->Url->build(['controller' => 'lessons','action' =>'lesson4']); ?>">
          ログイン機能の実装
        </a>
      </td>
		</tr>
	</tbody>
</table>
