<div class="listing">
<h1>Full Logs (Page <?php echo $page ?>)</h1>
<?php if ($rows): ?>
<table width="100%" style="border: 1px solid grey;">
    <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>IP</th>
    <th>Agent</th>
    <th>Date Time</th>
    <th>Color</th>
    </tr>
    <?php foreach($rows as $row): ?>
    <tr>
    <?php foreach($row as $col): ?>
    <td>
    <?php if(is_array($col)): ?>
        <?php echo implode('<br/>', $col) ?>
    <?php else: ?>
        <?php echo $col ?>
    <?php endif ?>
    </td>
    <?php endforeach ?>
    </tr>
    <?php endforeach ?>
</table>
<?php else: ?>
No Logs
<?php endif ?>
<?php echo $pagination ?>
</div>
