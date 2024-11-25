import { html } from '../../../deps.js';

export function TableHead({ users }) {
    return html`<thead>
        <tr>
            ${users.map(
                (user, userIdx) =>
                    html`<th key=${`th_${userIdx}`} data-user-id=${user.id}>${user.name}</th>`,
            )}
        </tr>
    </thead>`;
}
