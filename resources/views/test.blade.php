test
<?php $desc = $events->where('slug', 'this-is-halloween-2-floors-hexenhaus-mit-den-besten-djs-der-verdammnis-fue-event-mit-inferno')->first()->desc_long;
  dd(clean(str_limit($desc, 300)));
?>