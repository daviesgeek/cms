<div ui-view="">
  <div text-angular ng-model="edits.main.text" ng-show="editing == true">
  </div>
  <button ng-click="toggleEdit()" class="btn btn-primary">Edit</button>
  <div ng-show="editing != true">
    <div ng-bind-html="edits.main.text"></div>
  </div>  
</div>
