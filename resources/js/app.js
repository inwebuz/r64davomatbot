import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";

document.addEventListener('livewire:navigated', () => {

    flatpickr(".date-picker", {
        dateFormat: "d.m.Y",
    });
    flatpickr(".datetime-picker", {
        dateFormat: "d.m.Y H:i",
        enableTime: true,
        time_24hr: true,
    });
    document.querySelectorAll('.daterange-picker').forEach(wrapper => {
        const input = wrapper.querySelector('input');
        if (!input || input._flatpickr) {
            return;
        }
        flatpickr(input, {
            mode: 'range',
            dateFormat: 'd.m.Y',
            locale: {
                rangeSeparator: ' - ',
            },
            onChange: function (selectedDates, dateStr) {
                if (selectedDates.length < 2) {
                    return;
                }
                if (input.dataset.target) {
                    const target = document.querySelector(input.dataset.target);
                    if (target) {
                        target.value = dateStr;
                        target.dispatchEvent(new Event('input'));
                    }
                }
            }
        });
    });
});
