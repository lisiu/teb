import * as React from 'react'
import {FC} from 'react'
import Button from 'react-bootstrap/Button';

interface Props {
    disabled: boolean;
    onClick: () => void;
}

const StepForward: FC<Props> = ({disabled, onClick}: Props) => {
    const handleClick = () => {
        onClick()
    }

    return (
        <Button disabled={disabled} variant="outline-primary" size="lg" block onClick={handleClick}>Dalej</Button>
    )
}

export default StepForward
