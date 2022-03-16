import { PowerShell } from 'node-powershell';

export const shellExec = () => {
    PowerShell.$`echo "hello from PowerShell"`;
}