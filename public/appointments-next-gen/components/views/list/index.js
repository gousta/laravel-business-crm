import { html, React } from '../../../deps.js';
import { TableHead } from './head.js';

export function List({ users, hours }) {
    const [appointments, setAppointments] = React.useState([]);

    React.useEffect(() => {
        const table = document.querySelector('.table');
        let isDragging = false;
        let columnIndex = null; // Tracks the column being selected
        let startRowIndex = null; // Tracks the initial row index for selection

        table.addEventListener('mousedown', (event) => {
            if (event.target.tagName !== 'TD') return;

            isDragging = true;

            // Clear existing selections if starting a new drag
            table.querySelectorAll('td.selected').forEach((cell) => {
                cell.classList.remove('selected');
            });

            const cell = event.target;
            columnIndex = cell.cellIndex; // Track the column
            startRowIndex = cell.parentNode.rowIndex; // Track the starting row
            cell.classList.add('selected');
        });

        table.addEventListener('mousemove', (event) => {
            if (!isDragging || event.target.tagName !== 'TD') return;

            const cell = event.target;
            if (cell.cellIndex !== columnIndex) return; // Only allow selection in the same column

            const endRowIndex = cell.parentNode.rowIndex; // Track the current row index
            const start = Math.min(startRowIndex, endRowIndex);
            const end = Math.max(startRowIndex, endRowIndex);

            // Select all cells between startRowIndex and endRowIndex in the same column
            for (let i = start; i <= end; i++) {
                const row = table.rows[i];
                row.cells[columnIndex].classList.add('selected');
            }
        });

        table.addEventListener('mouseup', () => {
            if (!isDragging) return;
            isDragging = false;

            const userId = +table.rows[0].cells[columnIndex].dataset.userId;
            // Log selected slots
            const slots = Array.from(table.querySelectorAll('td.selected')).map(
                (c) => c.textContent,
            );

            console.log('Selected slots:', { userId }, { slots });

            setAppointments(slots);
        });

        // Prevent text selection while dragging
        table.addEventListener('dragstart', (event) => event.preventDefault());
        table.addEventListener('selectstart', (event) => event.preventDefault());
    }, []);

    return html`
        <div className="table-wrap">
            <pre>
                <code>
                    ${JSON.stringify(appointments, null, 2)}
                </code>
            </pre>
            <table className="table table-bordered table-condensed">
                <${TableHead} users=${users} />
                <tbody>
                    ${hours.map(
                        (hour, hourIdx) => html`
                            <tr key=${`slot_hour_${hourIdx}`}>
                                ${users.map(
                                    (_user, userIdx) => html`
                                        <td key=${`slot_hour_${hourIdx}_user_${userIdx}`}>
                                            ${hour}
                                        </td>
                                    `,
                                )}
                            </tr>
                        `,
                    )}
                </tbody>
            </table>
        </div>
    `;
}
