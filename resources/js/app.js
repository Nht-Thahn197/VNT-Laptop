import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('[data-nav-toggle]');
    const menu = document.querySelector('[data-nav-menu]');

    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            const expanded = menu.classList.contains('hidden') ? 'false' : 'true';
            toggle.setAttribute('aria-expanded', expanded);
        });
    }

    const customSelects = new Set();

    const closeSelect = (wrapper) => {
        if (!wrapper) {
            return;
        }
        wrapper.classList.remove('is-open');
        const panel = wrapper.querySelector('.custom-select__panel');
        const button = wrapper.querySelector('.custom-select__button');
        if (panel) {
            panel.classList.add('hidden');
        }
        if (button) {
            button.setAttribute('aria-expanded', 'false');
        }
    };

    const closeAll = (except) => {
        customSelects.forEach((wrapper) => {
            if (wrapper !== except) {
                closeSelect(wrapper);
            }
        });
    };

    const buildLabel = (select, isMultiple) => {
        const options = Array.from(select.options);
        const placeholderOption = options.find((option) => option.value === '' && !option.disabled);
        if (!isMultiple) {
            const selected = options.find((option) => option.selected) || placeholderOption;
            return selected ? selected.text : 'Chọn...';
        }

        const selectedOptions = options.filter((option) => option.selected && option.value !== '');
        if (selectedOptions.length === 0) {
            return select.dataset.placeholder || (placeholderOption ? placeholderOption.text : 'Chọn...');
        }
        if (selectedOptions.length <= 2) {
            return selectedOptions.map((option) => option.text).join(', ');
        }
        return `${selectedOptions.length} đã chọn`;
    };

    const extractLayoutClasses = (classList) =>
        Array.from(classList).filter((cls) => {
            if (cls === 'soft-input') {
                return false;
            }
            const base = cls.split(':').pop();
            return (
                base.startsWith('m-') ||
                base.startsWith('mt-') ||
                base.startsWith('mb-') ||
                base.startsWith('ml-') ||
                base.startsWith('mr-') ||
                base.startsWith('mx-') ||
                base.startsWith('my-') ||
                base.startsWith('w-') ||
                base.startsWith('max-w-') ||
                base.startsWith('min-w-') ||
                base.startsWith('col-span-') ||
                base.startsWith('self-')
            );
        });

    const enhanceSelect = (select) => {
        if (select.dataset.customized === 'true') {
            return;
        }

        const isMultiple = select.multiple;
        const wrapper = document.createElement('div');
        wrapper.className = 'custom-select';
        const layoutClasses = extractLayoutClasses(select.classList);
        if (layoutClasses.length) {
            wrapper.classList.add(...layoutClasses);
        }

        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'soft-input custom-select__button';
        button.setAttribute('aria-haspopup', 'listbox');
        button.setAttribute('aria-expanded', 'false');

        const label = document.createElement('span');
        label.className = 'custom-select__label';
        label.textContent = buildLabel(select, isMultiple);

        const caret = document.createElement('span');
        caret.className = 'custom-select__caret';

        button.append(label, caret);

        const panel = document.createElement('div');
        panel.className = 'custom-select__panel hidden';
        panel.setAttribute('role', 'listbox');

        Array.from(select.options).forEach((option, index) => {
            const optionLabel = document.createElement('label');
            optionLabel.className = 'custom-select__option';
            if (option.disabled) {
                optionLabel.classList.add('is-disabled');
            }

            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.className = 'custom-select__checkbox';
            checkbox.checked = option.selected;
            checkbox.disabled = option.disabled;
            checkbox.dataset.index = String(index);

            const text = document.createElement('span');
            text.textContent = option.text;

            optionLabel.append(checkbox, text);
            panel.append(optionLabel);
        });

        const parent = select.parentNode;
        parent.insertBefore(wrapper, select);
        wrapper.append(button, panel, select);

        select.classList.add('custom-select__native');
        select.dataset.customized = 'true';

        const syncCheckboxes = () => {
            const options = Array.from(select.options);
            panel.querySelectorAll('.custom-select__checkbox').forEach((checkbox) => {
                const index = Number(checkbox.dataset.index);
                checkbox.checked = options[index]?.selected ?? false;
            });
            label.textContent = buildLabel(select, isMultiple);
        };

        panel.addEventListener('change', (event) => {
            const checkbox = event.target;
            if (!checkbox.classList.contains('custom-select__checkbox')) {
                return;
            }
            const index = Number(checkbox.dataset.index);
            if (Number.isNaN(index)) {
                return;
            }

            const options = Array.from(select.options);
            if (!isMultiple) {
                options.forEach((option, optionIndex) => {
                    option.selected = optionIndex === index;
                });
            } else {
                const option = options[index];
                if (option) {
                    option.selected = checkbox.checked;
                }
            }

            syncCheckboxes();
            select.dispatchEvent(new Event('change', { bubbles: true }));
        });

        button.addEventListener('click', () => {
            const isOpen = wrapper.classList.toggle('is-open');
            panel.classList.toggle('hidden', !isOpen);
            button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            if (isOpen) {
                closeAll(wrapper);
            }
        });

        customSelects.add(wrapper);
    };

    document.querySelectorAll('select').forEach((select) => {
        if (select.dataset.nativeSelect === 'true') {
            return;
        }
        enhanceSelect(select);
    });

    document.addEventListener('click', (event) => {
        customSelects.forEach((wrapper) => {
            if (!wrapper.contains(event.target)) {
                closeSelect(wrapper);
            }
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') {
            return;
        }
        customSelects.forEach((wrapper) => closeSelect(wrapper));
    });
});
