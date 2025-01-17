import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// フラッシュメッセージ
document.addEventListener('DOMContentLoaded', () => {
  const alert = document.querySelector('.alert');
  if (alert) {
    setTimeout(() => {
      alert.style.display = 'none';
    }, 3000);
  }
});

// 削除確認ダイアログ
document.addEventListener('DOMContentLoaded', () => {
  const deleteButton = document.querySelector('.confirm_delete');
  if (deleteButton) {
    deleteButton.addEventListener('click', event => {
      if (!confirm("本当に削除しますか？")) {
        event.preventDefault();
      }
    });
  }
});