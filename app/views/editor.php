<?php if($editAccess == true): ?>

  <div ng-init="currentSection='<?=$section?>'" ui-view="" cms-edit-area ng-controller="edit">
    <button class="btn" ng-click="toggleEditing()">
      <span ng-show="!isEditing">Edit</span>
      <span ng-show="isEditing">Save Edits</span>
    </button>
    <text-angular-toolbar name="toolbar1"></text-angular-toolbar>
    <div text-angular ng-model="html" ng-show="isEditing", ta-target-toolbars='toolbar1'>
      <?= $edits[$section]['text'] ?>
    </div>
    <div ng-show="!isEditing" ng-bind-html="html">
    </div>
  </div>

<?php else: ?>
  
  <div>
    <?= $edits[$section]['text'] ?>
  </div>

<?php endif; ?>