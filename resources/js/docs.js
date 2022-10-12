import './bootstrap';
import Alpine from 'alpinejs';
import Focus from '@alpinejs/focus';
import SearchComponent from './docs/components/search';
import './docs/clipboard';
import './docs/docs';

window.Alpine = Alpine;
window.searchComponent = SearchComponent;

Alpine.plugin(Focus);
Alpine.start();

// document.addEventListener('DOMContentLoaded', () => {
//     if (document.querySelector('#docsScreen')) {
//         import './docs';
//     }
//
//     require('./components/accessibility');
// });
