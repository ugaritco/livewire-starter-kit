import { Passkeys } from '@ugarit/passkeys';

window.Passkeys = Passkeys;
window.dispatchEvent(new CustomEvent('passkeys:ready'));
