# Build ACTIONS-FILTERS.md
php create-actions-filters-docs.php

# Generate .pot file
php -n $(which wp) i18n make-pot ../ ../languages/page-generator.pot